<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Runtime;

use KaririCode\Exception\Runtime\RuntimeException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class RuntimeExceptionTest extends AbstractExceptionTest
{
    public function testUnexpectedValue(): void
    {
        $details = 'Unexpected null value';
        $exception = RuntimeException::unexpectedValue($details);
        $this->assertExceptionStructure($exception, 'UNEXPECTED_VALUE', "Unexpected value: {$details}");
    }

    public function testOutOfMemory(): void
    {
        $exception = RuntimeException::outOfMemory();
        $this->assertExceptionStructure($exception, 'OUT_OF_MEMORY', 'Out of memory error');
    }

    public function testClassNotFound(): void
    {
        $className = 'App\NonExistentClass';
        $exception = RuntimeException::classNotFound($className);
        $this->assertExceptionStructure($exception, 'CLASS_NOT_FOUND', "Class not found: {$className}");
    }
}
