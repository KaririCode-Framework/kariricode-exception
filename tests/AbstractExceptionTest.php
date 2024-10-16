<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;
use PHPUnit\Framework\TestCase;

class AbstractExceptionTest extends TestCase
{
    private ConcreteTestException $exception;

    protected function setUp(): void
    {
        $errorMessage = new ExceptionMessage(9999, 'TEST_CODE', 'Test message');
        $this->exception = new ConcreteTestException($errorMessage);
    }

    public function testExceptionCreation(): void
    {
        $this->assertSame('Test message', $this->exception->getMessage());
        $this->assertSame(['code' => 'TEST_CODE'], $this->exception->getContext());
        $this->assertSame('TEST_CODE', $this->exception->getErrorCode());
        $this->assertSame(9999, $this->exception->getCode());
    }

    public function testExceptionWithContext(): void
    {
        $errorMessage = new ExceptionMessage(9999, 'TEST_CODE', 'Test message');
        $context = ['key' => 'value'];
        $exception = new ConcreteTestException($errorMessage, null, $context);

        $this->assertSame(['code' => 'TEST_CODE', 'key' => 'value'], $exception->getContext());
        $this->assertSame('TEST_CODE', $exception->getErrorCode());
        $this->assertSame(9999, $exception->getCode());
    }

    public function testAddContext(): void
    {
        $this->exception->addTestContext('newKey', 'newValue');

        $expectedContext = ['code' => 'TEST_CODE', 'newKey' => 'newValue'];
        $this->assertSame($expectedContext, $this->exception->getContext());
    }

    public function testExceptionWithPrevious(): void
    {
        $previousException = new \Exception('Previous exception');
        $errorMessage = new ExceptionMessage(9999, 'TEST_CODE', 'Test message');
        $exception = new ConcreteTestException($errorMessage, $previousException);

        $this->assertSame($previousException, $exception->getPrevious());
        $this->assertSame(9999, $exception->getCode());
    }

    protected function assertExceptionStructure(AbstractException $exception, string $expectedErrorCode, string $expectedMessage, int $expectedCode): void
    {
        $this->assertInstanceOf(AbstractException::class, $exception);
        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertArrayHasKey('code', $exception->getContext());
        $this->assertSame($expectedErrorCode, $exception->getContext()['code']);
        $this->assertSame($expectedErrorCode, $exception->getErrorCode());
        $this->assertSame($expectedCode, $exception->getCode());
    }
}

// Implementação concreta de AbstractException para teste
final class ConcreteTestException extends AbstractException
{
    public function addTestContext(string $key, mixed $value): self
    {
        return $this->addContext($key, $value);
    }
}
