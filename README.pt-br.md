# KaririCode Framework: Exception Component

[![en](https://img.shields.io/badge/lang-en-red.svg)](README.md) [![pt-br](https://img.shields.io/badge/lang-pt--br-green.svg)](README.pt-br.md)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) ![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white) ![PHPUnit](https://img.shields.io/badge/PHPUnit-3776AB?style=for-the-badge&logo=php&logoColor=white)

Um componente abrangente e flexível de tratamento de exceções para PHP, parte do KaririCode Framework. Ele fornece uma abordagem estruturada para o gerenciamento de erros, melhorando a robustez e a manutenção das suas aplicações.

## Índice

- [Funcionalidades](#funcionalidades)
- [Instalação](#instalação)
- [Uso](#uso)
  - [Uso Básico](#uso-básico)
  - [Uso Avançado](#uso-avançado)
- [Tabela de Faixas de Código de Erro](#tabela-de-faixas-de-código-de-erro)
- [Tipos de Exceção Disponíveis](#tipos-de-exceção-disponíveis)
- [Integração com Outros Componentes do KaririCode](#integração-com-outros-componentes-do-kariricode)
- [Desenvolvimento e Testes](#desenvolvimento-e-testes)
- [Licença](#licença)
- [Suporte e Comunidade](#suporte-e-comunidade)

## Funcionalidades

- Estrutura hierárquica de exceções para melhor categorização de erros
- Exceções conscientes de contexto para informações de erro mais ricas
- Métodos de fábrica estáticos para fácil criação de exceções
- Integração com os sistemas de tratamento de erros e logs do KaririCode
- Arquitetura extensível permitindo tipos de exceção personalizados
- Conjunto abrangente de tipos de exceção pré-definidos para cenários comuns

## Instalação

Você pode instalar o componente de Exceção via Composer:

```bash
composer require kariricode/exception
```

### Requisitos

- PHP 8.1 ou superior
- Composer

## Uso

### Uso Básico

#### Usando Exceções Pré-definidas no Seu Código

O componente KaririCode Exception oferece uma variedade de exceções pré-definidas que você pode usar para lidar com cenários comuns de erro de maneira profissional e estruturada. Abaixo está um exemplo de como usar essas exceções em um contexto orientado a objetos.

```php
<?php

declare(strict_types=1);

namespace YourApp\Controller;

use YourApp\Service\UserService;
use KaririCode\Contract\Http\Response;
use KaririCode\Contract\Http\ServerRequest;
use KaririCode\Router\Attributes\Route;

final class UserController extends BaseController
{
    public function __construct(private UserService $userService)
    {
    }

    #[Route('/user/{userId}', methods: ['GET'])]
    public function getUserData(ServerRequest $request, Response $response): Response
    {
        $userId = (int)$request->getAttribute('userId');

        $userData = $this->userService->getUserData($userId);
        return $this->responseBuilder($response)
            ->setData($userData)
            ->setHeader('Content-Type', 'application/json')
            ->setStatus(200)
            ->build();
    }
}

// UserService.php
namespace YourApp\Service;

use YourApp\Repository\UserRepository;
use KaririCode\Contract\Log\Logger;

class UserService
{
    private UserRepository $userRepository;
    private Logger $logger;

    public function __construct(UserRepository $userRepository, Logger $logger)
    {
        $this->userRepository = $userRepository;
        $this->logger = $logger;
    }

    public function getUserData(int $userId): array
    {
        return $this->userRepository->findUserById($userId);
    }
}

// UserRepository.php
namespace YourApp\Repository;

use KaririCode\Contract\Database\EntityManager;
use KaririCode\Exception\Database\DatabaseException;

class UserRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findUserById(int $userId): array
    {
        $sql = 'SELECT * FROM users WHERE id = ?';
        $userData = $this->entityManager->query($sql, [$userId]);

        if ($userData === false) {
            throw DatabaseException::queryError($sql, $this->entityManager->getLastError());
        }

        return $userData;
    }
}

```

### Uso Avançado

Crie exceções personalizadas estendendo as classes base:

```php
<?php

declare(strict_types=1);

namespace YourApp\Exception;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class OrderException extends AbstractException
{
    private const CODE_ORDER_LIMIT_EXCEEDED = 4001;

    public static function orderLimitExceeded(float $totalAmount, float $userOrderLimit): self
    {
        return new self(new ExceptionMessage(
            self::CODE_ORDER_LIMIT_EXCEEDED,
            'ORDER_LIMIT_EXCEEDED',
            "Valor do pedido (${totalAmount}) excede o limite do usuário (${userOrderLimit})"
        ));
    }
}
```

Usando exceções personalizadas em sua aplicação:

```php
<?php

declare(strict_types=1);

namespace YourApp\Service;

use YourApp\Exception\OrderException;
use YourApp\Repository\OrderRepository;
use KaririCode\Contract\Log\Logger;
use KaririCode\Exception\Database\DatabaseException;

final class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private Logger $logger
    ) {
    }

    /**
     * @throws OrderException
     * @throws DatabaseException
     */
    public function placeOrder(int $userId, array $items, float $totalAmount): void
    {
		$userOrderLimit = $this->orderRepository->getUserOrderLimit($userId);

		if ($totalAmount > $userOrderLimit) {
			$this->logger->warning('Pedido excede o limite do usuário', [
				'userId' => $userId,
				'orderAmount' => $totalAmount,
				'userLimit' => $userOrderLimit,
			]);

			throw OrderException::orderLimitExceeded($totalAmount, $userOrderLimit);
		}

		$this->orderRepository->createOrder($userId, $items, $totalAmount);

    }
}
```

## Tabela de Faixas de Código de Erro

Aqui está uma tabela proposta para as **faixas de código de erro**. Cada faixa é atribuída a um grupo de erros relacionados, permitindo melhor organização e identificação de erros no sistema.

### Tabela de Faixas de Código de Erro

| Faixa           | Grupo de Erro                    | Descrição                                               |
| --------------- | -------------------------------- | ------------------------------------------------------- |
| **1000 - 1099** | **Erros de Autenticação**        | Erros relacionados à autenticação e login               |
| **1100 - 1199** | **Erros de Autorização**         | Erros relacionados a permissões e funções               |
| **1200 - 1299** | **Erros de Cache**               | Erros relacionados a operações de cache                 |
| **1300 - 1399** | **Erros de Configuração**        | Erros relacionados a configurações                      |
| **1400 - 1499** | **Erros de Container**           | Erros relacionados à injeção de dependências e serviços |
| **1500 - 1599** | **Erros de Banco de Dados**      | Erros relacionados a conexões, consultas, etc.          |
| **1600 - 1699** | **Erros de Evento**              | Erros relacionados ao manuseio e despacho de eventos    |
| **1700 - 1799** | **Erros de Serviços Externos**   | Erros relacionados a chamadas e serviços externos       |
| **1800 - 1899** | **Erros de Sistema de Arquivos** | Erros relacionados a operações de arquivos              |
| **1900 - 1999** | **Erros de Validação/Entrada**   | Erros relacionados a validação ou entrada inválida      |
| **2000 - 2099** | **Erros de Localização**         | Erros relacionados à localização e traduções            |
| **2100 - 2199** | **Erros de Middleware**          | Erros relacionados ao processamento de middleware       |
| **2200 - 2299** | **Erros de Rede**                | Erros relacionados a operações de rede                  |
| **2300 - 2399** | **Erros de Fila**                | Erros relacionados a sistemas de fila                   |
| **2400 - 2499** | **Erros de Roteamento**          | Erros relacionados a roteamento e métodos HTTP          |

| **2500 - 2599** | **Erros de Tempo de Execução** | Erros gerais de tempo de execução |
| **2600 - 2699** | **Erros de Criptografia** | Erros relacionados a criptografia e descriptografia |
| **2700 - 2799** | **Erros de Segurança** | Erros relacionados à segurança e controle de acesso |
| **2800 - 2899** | **Erros de Sessão** | Erros relacionados ao gerenciamento de sessões |
| **2900 - 2999** | **Erros de Sistema** | Erros relacionados a recursos do sistema e ambiente |
| **3000 - 3099** | **Erros de Template** | Erros relacionados a renderização e carregamento de templates |
| **3100 - 3199** | **Erros de Validação** | Erros relacionados à validação de dados |
| **4000 - 4099** | **Erros de Lógica de Negócios** | Erros personalizados para violações de lógica de negócios |

### Explicação de Cada Faixa:

1. **1000 - 1099: Erros de Autenticação**

   - Erros relacionados à autenticação do usuário, como credenciais inválidas, contas bloqueadas ou autenticação de dois fatores ausente.

2. **1100 - 1199: Erros de Autorização**

   - Erros relacionados a permissões insuficientes ou funções ausentes durante processos de autorização.

3. **... (Mesma descrição das faixas anteriores)**

4. **3100 - 3199: Erros de Validação**

   - Erros relacionados à validação de dados.

5. **4000 - 4099: Erros de Lógica de Negócios**
   - Códigos de erro personalizados para violações de lógica de negócios específicas da sua aplicação.

Essa estrutura permite que você categorize e expanda facilmente os códigos de erro no futuro, mantendo o sistema de tratamento de erros organizado.

## Tipos de Exceção Disponíveis

Cada tipo de exceção é projetado para lidar com cenários específicos de erro. Para informações detalhadas sobre cada tipo de exceção, consulte a [documentação](https://kariricode.org/docs/exception).

## Integração com Outros Componentes do KaririCode

O componente de Exceção foi projetado para funcionar perfeitamente com outros componentes do KaririCode:

- **KaririCode\Logger**: Para logs e relatórios de erros avançados.
- **KaririCode\Http**: Para tratamento de exceções relacionadas a HTTP.
- **KaririCode\Database**: Para exceções específicas de banco de dados.

## Desenvolvimento e Testes

Para fins de desenvolvimento e testes, este pacote utiliza Docker e Docker Compose para garantir consistência entre diferentes ambientes. Um Makefile é fornecido para conveniência.

### Pré-requisitos

- Docker
- Docker Compose
- Make (opcional, mas recomendado para facilitar a execução de comandos)

### Configuração de Desenvolvimento

1. Clone o repositório:

   ```bash
   git clone https://github.com/KaririCode-Framework/kariricode-exception.git
   cd kariricode-exception
   ```

2. Configure o ambiente:

   ```bash
   make setup-env
   ```

3. Inicie os containers do Docker:

   ```bash
   make up
   ```

4. Instale as dependências:

   ```bash
   make composer-install
   ```

### Comandos Make Disponíveis

- `make up`: Inicia todos os serviços em segundo plano
- `make down`: Para e remove todos os containers
- `make build`: Constrói as imagens Docker
- `make shell`: Acessa o shell do container PHP
- `make test`: Executa os testes
- `make coverage`: Executa a cobertura dos testes com formatação visual
- `make cs-fix`: Executa o PHP CS Fixer para corrigir o estilo do código
- `make quality`: Executa todos os comandos de qualidade (cs-check, test, security-check)

Para uma lista completa de comandos disponíveis, execute:

```bash
make help
```

## Licença

Este projeto é licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## Suporte e Comunidade

- **Documentação**: [https://kariricode.org/docs/exception](https://kariricode.org/docs/exception)
- **Rastreador de Problemas**: [GitHub Issues](https://github.com/KaririCode-Framework/kariricode-exception/issues)
- **Comunidade**: [KaririCode Club Community](https://kariricode.club)

---

Desenvolvido com ❤️ pela equipe KaririCode. Capacitando desenvolvedores a lidar com erros de forma eficaz e construir aplicações PHP mais resilientes.Aqui está o README traduzido para o português:

---

# KaririCode Framework: Componente de Exceções

[![en](https://img.shields.io/badge/lang-en-red.svg)](README.md) [![pt-br](https://img.shields.io/badge/lang-pt--br-green.svg)](README.pt-br.md)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) ![Docker](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=white) ![PHPUnit](https://img.shields.io/badge/PHPUnit-3776AB?style=for-the-badge&logo=php&logoColor=white)

Um componente abrangente e flexível de tratamento de exceções para PHP, parte do KaririCode Framework. Ele fornece uma abordagem estruturada para o gerenciamento de erros, melhorando a robustez e a manutenção das suas aplicações.

## Índice

- [Funcionalidades](#funcionalidades)
- [Instalação](#instalação)
- [Uso](#uso)
  - [Uso Básico](#uso-básico)
  - [Uso Avançado](#uso-avançado)
- [Tabela de Faixas de Código de Erro](#tabela-de-faixas-de-código-de-erro)
- [Tipos de Exceção Disponíveis](#tipos-de-exceção-disponíveis)
- [Integração com Outros Componentes do KaririCode](#integração-com-outros-componentes-do-kariricode)
- [Desenvolvimento e Testes](#desenvolvimento-e-testes)
- [Licença](#licença)
- [Suporte e Comunidade](#suporte-e-comunidade)

## Funcionalidades

- Estrutura hierárquica de exceções para melhor categorização de erros
- Exceções conscientes de contexto para informações de erro mais ricas
- Métodos de fábrica estáticos para fácil criação de exceções
- Integração com os sistemas de tratamento de erros e logs do KaririCode
- Arquitetura extensível permitindo tipos de exceção personalizados
- Conjunto abrangente de tipos de exceção pré-definidos para cenários comuns

## Instalação

Você pode instalar o componente de Exceção via Composer:

```bash
composer require kariricode/exception
```

### Requisitos

- PHP 8.1 ou superior
- Composer

## Uso

### Uso Básico

#### Usando Exceções Pré-definidas no Seu Código

O componente KaririCode Exception oferece uma variedade de exceções pré-definidas que você pode usar para lidar com cenários comuns de erro de maneira profissional e estruturada. Abaixo está um exemplo de como usar essas exceções em um contexto orientado a objetos.

```php
<?php

declare(strict_types=1);

namespace YourApp\Controller;

use YourApp\Service\UserService;
use KaririCode\Contract\Http\Response;
use KaririCode\Contract\Http\ServerRequest;
use KaririCode\Router\Attributes\Route;

final class UserController extends BaseController
{
    public function __construct(private UserService $userService)
    {
    }

    #[Route('/user/{userId}', methods: ['GET'])]
    public function getUserData(ServerRequest $request, Response $response): Response
    {
        $userId = (int)$request->getAttribute('userId');

        $userData = $this->userService->getUserData($userId);
        return $this->responseBuilder($response)
            ->setData($userData)
            ->setHeader('Content-Type', 'application/json')
            ->setStatus(200)
            ->build();
    }
}

// UserService.php
namespace YourApp\Service;

use YourApp\Repository\UserRepository;
use KaririCode\Contract\Log\Logger;

class UserService
{
    private UserRepository $userRepository;
    private Logger $logger;

    public function __construct(UserRepository $userRepository, Logger $logger)
    {
        $this->userRepository = $userRepository;
        $this->logger = $logger;
    }

    public function getUserData(int $userId): array
    {
        return $this->userRepository->findUserById($userId);
    }
}

// UserRepository.php
namespace YourApp\Repository;

use KaririCode\Contract\Database\EntityManager;
use KaririCode\Exception\Database\DatabaseException;

class UserRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function findUserById(int $userId): array
    {
        $sql = 'SELECT * FROM users WHERE id = ?';
        $userData = $this->entityManager->query($sql, [$userId]);

        if ($userData === false) {
            throw DatabaseException::queryError($sql, $this->entityManager->getLastError());
        }

        return $userData;
    }
}

```

### Uso Avançado

Crie exceções personalizadas estendendo as classes base:

```php
<?php

declare(strict_types=1);

namespace YourApp\Exception;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class OrderException extends AbstractException
{
    private const CODE_ORDER_LIMIT_EXCEEDED = 4001;

    public static function orderLimitExceeded(float $totalAmount, float $userOrderLimit): self
    {
        return new self(new ExceptionMessage(
            self::CODE_ORDER_LIMIT_EXCEEDED,
            'ORDER_LIMIT_EXCEEDED',
            "Valor do pedido (${totalAmount}) excede o limite do usuário (${userOrderLimit})"
        ));
    }
}
```

Usando exceções personalizadas em sua aplicação:

```php
<?php

declare(strict_types=1);

namespace YourApp\Service;

use YourApp\Exception\OrderException;
use YourApp\Repository\OrderRepository;
use KaririCode\Contract\Log\Logger;
use KaririCode\Exception\Database\DatabaseException;

final class OrderService
{
    public function __construct(
        private OrderRepository $orderRepository,
        private Logger $logger
    ) {
    }

    /**
     * @throws OrderException
     * @throws DatabaseException
     */
    public function placeOrder(int $userId, array $items, float $totalAmount): void
    {
		$userOrderLimit = $this->orderRepository->getUserOrderLimit($userId);

		if ($totalAmount > $userOrderLimit) {
			$this->logger->warning('Pedido excede o limite do usuário', [
				'userId' => $userId,
				'orderAmount' => $totalAmount,
				'userLimit' => $userOrderLimit,
			]);

			throw OrderException::orderLimitExceeded($totalAmount, $userOrderLimit);
		}

		$this->orderRepository->createOrder($userId, $items, $totalAmount);

    }
}
```

## Tabela de Faixas de Código de Erro

Aqui está uma tabela proposta para as **faixas de código de erro**. Cada faixa é atribuída a um grupo de erros relacionados, permitindo melhor organização e identificação de erros no sistema.

### Tabela de Faixas de Código de Erro

| Faixa           | Grupo de Erro                    | Descrição                                               |
| --------------- | -------------------------------- | ------------------------------------------------------- |
| **1000 - 1099** | **Erros de Autenticação**        | Erros relacionados à autenticação e login               |
| **1100 - 1199** | **Erros de Autorização**         | Erros relacionados a permissões e funções               |
| **1200 - 1299** | **Erros de Cache**               | Erros relacionados a operações de cache                 |
| **1300 - 1399** | **Erros de Configuração**        | Erros relacionados a configurações                      |
| **1400 - 1499** | **Erros de Container**           | Erros relacionados à injeção de dependências e serviços |
| **1500 - 1599** | **Erros de Banco de Dados**      | Erros relacionados a conexões, consultas, etc.          |
| **1600 - 1699** | **Erros de Evento**              | Erros relacionados ao manuseio e despacho de eventos    |
| **1700 - 1799** | **Erros de Serviços Externos**   | Erros relacionados a chamadas e serviços externos       |
| **1800 - 1899** | **Erros de Sistema de Arquivos** | Erros relacionados a operações de arquivos              |
| **1900 - 1999** | **Erros de Validação/Entrada**   | Erros relacionados a validação ou entrada inválida      |
| **2000 - 2099** | **Erros de Localização**         | Erros relacionados à localização e traduções            |
| **2100 - 2199** | **Erros de Middleware**          | Erros relacionados ao processamento de middleware       |
| **2200 - 2299** | **Erros de Rede**                | Erros relacionados a operações de rede                  |
| **2300 - 2399** | **Erros de Fila**                | Erros relacionados a sistemas de fila                   |
| **2400 - 2499** | **Erros de Roteamento**          | Erros relacionados a roteamento e métodos HTTP          |

| **2500 - 2599** | **Erros de Tempo de Execução** | Erros gerais de tempo de execução |
| **2600 - 2699** | **Erros de Criptografia** | Erros relacionados a criptografia e descriptografia |
| **2700 - 2799** | **Erros de Segurança** | Erros relacionados à segurança e controle de acesso |
| **2800 - 2899** | **Erros de Sessão** | Erros relacionados ao gerenciamento de sessões |
| **2900 - 2999** | **Erros de Sistema** | Erros relacionados a recursos do sistema e ambiente |
| **3000 - 3099** | **Erros de Template** | Erros relacionados a renderização e carregamento de templates |
| **3100 - 3199** | **Erros de Validação** | Erros relacionados à validação de dados |
| **4000 - 4099** | **Erros de Lógica de Negócios** | Erros personalizados para violações de lógica de negócios |

### Explicação de Cada Faixa:

1. **1000 - 1099: Erros de Autenticação**

   - Erros relacionados à autenticação do usuário, como credenciais inválidas, contas bloqueadas ou autenticação de dois fatores ausente.

2. **1100 - 1199: Erros de Autorização**

   - Erros relacionados a permissões insuficientes ou funções ausentes durante processos de autorização.

3. **... (Mesma descrição das faixas anteriores)**

4. **3100 - 3199: Erros de Validação**

   - Erros relacionados à validação de dados.

5. **4000 - 4099: Erros de Lógica de Negócios**
   - Códigos de erro personalizados para violações de lógica de negócios específicas da sua aplicação.

Essa estrutura permite que você categorize e expanda facilmente os códigos de erro no futuro, mantendo o sistema de tratamento de erros organizado.

## Tipos de Exceção Disponíveis

Cada tipo de exceção é projetado para lidar com cenários específicos de erro. Para informações detalhadas sobre cada tipo de exceção, consulte a [documentação](https://kariricode.org/docs/exception).

## Integração com Outros Componentes do KaririCode

O componente de Exceção foi projetado para funcionar perfeitamente com outros componentes do KaririCode:

- **KaririCode\Logger**: Para logs e relatórios de erros avançados.
- **KaririCode\Http**: Para tratamento de exceções relacionadas a HTTP.
- **KaririCode\Database**: Para exceções específicas de banco de dados.

## Desenvolvimento e Testes

Para fins de desenvolvimento e testes, este pacote utiliza Docker e Docker Compose para garantir consistência entre diferentes ambientes. Um Makefile é fornecido para conveniência.

### Pré-requisitos

- Docker
- Docker Compose
- Make (opcional, mas recomendado para facilitar a execução de comandos)

### Configuração de Desenvolvimento

1. Clone o repositório:

   ```bash
   git clone https://github.com/KaririCode-Framework/kariricode-exception.git
   cd kariricode-exception
   ```

2. Configure o ambiente:

   ```bash
   make setup-env
   ```

3. Inicie os containers do Docker:

   ```bash
   make up
   ```

4. Instale as dependências:

   ```bash
   make composer-install
   ```

### Comandos Make Disponíveis

- `make up`: Inicia todos os serviços em segundo plano
- `make down`: Para e remove todos os containers
- `make build`: Constrói as imagens Docker
- `make shell`: Acessa o shell do container PHP
- `make test`: Executa os testes
- `make coverage`: Executa a cobertura dos testes com formatação visual
- `make cs-fix`: Executa o PHP CS Fixer para corrigir o estilo do código
- `make quality`: Executa todos os comandos de qualidade (cs-check, test, security-check)

Para uma lista completa de comandos disponíveis, execute:

```bash
make help
```

## Licença

Este projeto é licenciado sob a Licença MIT - veja o arquivo [LICENSE](LICENSE) para mais detalhes.

## Suporte e Comunidade

- **Documentação**: [https://kariricode.org/docs/exception](https://kariricode.org/docs/exception)
- **Rastreador de Problemas**: [GitHub Issues](https://github.com/KaririCode-Framework/kariricode-exception/issues)
- **Comunidade**: [KaririCode Club Community](https://kariricode.club)

---

Desenvolvido com ❤️ pela equipe KaririCode. Capacitando desenvolvedores a lidar com erros de forma eficaz e construir aplicações PHP mais resilientes.
