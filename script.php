<?php

declare(strict_types=1);

require 'vendor/autoload.php';
require 'code_mapping.php';

use PhpParser\Error;
use PhpParser\Modifiers;
use PhpParser\Node;
use PhpParser\Node\Scalar\Int_;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter;
use PhpParser\NodeVisitor\ParentConnectingVisitor;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\Node\Stmt\Class_;

// Diretório base a ser vasculhado
$baseDir = __DIR__ . '/src'; // Altere para o caminho correto

// Função para percorrer o diretório recursivamente
function scanDirectory(string $dir, array $codeMapping)
{
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }
        $filePath = $dir . DIRECTORY_SEPARATOR . $file;
        if (is_dir($filePath)) {
            scanDirectory($filePath, $codeMapping);
        } elseif (is_file($filePath) && pathinfo($filePath, PATHINFO_EXTENSION) === 'php') {
            processFile($filePath, $codeMapping);
        }
    }
}

// Função para processar cada arquivo
function processFile(string $filePath, array $codeMapping)
{
    $code = file_get_contents($filePath);

    $parserFactory = new ParserFactory();
    $parser = $parserFactory->createForNewestSupportedVersion();

    try {
        $ast = $parser->parse($code);
    } catch (Error $error) {
        echo "Erro ao analisar o arquivo {$filePath}: {$error->getMessage()}\n";
        return;
    }

    $traverser = new NodeTraverser();

    // Adicionar NameResolver
    $traverser->addVisitor(new NameResolver());

    // Adicionar ParentConnectingVisitor
    $traverser->addVisitor(new ParentConnectingVisitor());

    $visitor = new class ($codeMapping) extends NodeVisitorAbstract {
        private $codeMapping;
        private $currentClass;
        private $classNode;

        public function __construct(array $codeMapping)
        {
            $this->codeMapping = $codeMapping;
        }

        public function enterNode(Node $node)
        {
            if ($node instanceof Node\Stmt\Class_) {
                if (isset($node->namespacedName)) {
                    $this->currentClass = $node->namespacedName->toString();
                } else {
                    $this->currentClass = $node->name->toString();
                }
                $this->classNode = $node;
            }

            if ($node instanceof Node\Stmt\ClassMethod && $node->isStatic()) {
                if ($this->currentClass && isset($this->codeMapping[$this->currentClass])) {
                    $methodName = $node->name->toString();
                    if (isset($this->codeMapping[$this->currentClass][$methodName])) {
                        $codeInt = $this->codeMapping[$this->currentClass][$methodName];

                        // Adicionar a constante de código inteiro na classe, se ainda não existir
                        $constName = 'CODE_' . strtoupper($methodName);

                        // Verificar se a constante já existe
                        $constExists = false;
                        foreach ($this->classNode->stmts as $stmt) {
                            if ($stmt instanceof Node\Stmt\ClassConst) {
                                foreach ($stmt->consts as $const) {
                                    if ($const->name->toString() === $constName) {
                                        $constExists = true;
                                        break 2;
                                    }
                                }
                            }
                        }

                        if (!$constExists) {
                            $const = new Node\Stmt\ClassConst(
                                [
                                    new Node\Const_(
                                        new Node\Identifier($constName),
                                        new Int_($codeInt)
                                    )
                                ],
                                Modifiers::PRIVATE
                            );

                            // Inserir a constante no início dos statements da classe
                            array_unshift($this->classNode->stmts, $const);
                        }
                    }
                }
            }
        }
    };

    $traverser->addVisitor($visitor);
    $modifiedAst = $traverser->traverse($ast);

    // Converter o AST de volta para código PHP
    $prettyPrinter = new PrettyPrinter\Standard();
    $modifiedCode = $prettyPrinter->prettyPrintFile($modifiedAst);

    // Salvar o código modificado de volta no arquivo
    file_put_contents($filePath, $modifiedCode);
    echo "Arquivo atualizado: {$filePath}\n";
}

// Iniciar o processo de varredura
scanDirectory($baseDir, $codeMapping);

echo "Atualização concluída.\n";
