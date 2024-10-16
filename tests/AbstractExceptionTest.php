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
        $errorMessage = new ExceptionMessage('TEST_CODE', 'Test message');
        $this->exception = new ConcreteTestException($errorMessage);
    }

    public function testExceptionCreation(): void
    {
        $this->assertSame('Test message', $this->exception->getMessage());
        $this->assertSame(['code' => 'TEST_CODE'], $this->exception->getContext());
    }

    public function testExceptionWithContext(): void
    {
        $errorMessage = new ExceptionMessage('TEST_CODE', 'Test message');
        $context = ['key' => 'value'];
        $exception = new ConcreteTestException($errorMessage, null, $context);

        $this->assertSame(['code' => 'TEST_CODE', 'key' => 'value'], $exception->getContext());
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
        $errorMessage = new ExceptionMessage('TEST_CODE', 'Test message');
        $exception = new ConcreteTestException($errorMessage, $previousException);

        $this->assertSame($previousException, $exception->getPrevious());
    }

    protected function assertExceptionStructure(AbstractException $exception, string $expectedCode, string $expectedMessage): void
    {
        $this->assertInstanceOf(AbstractException::class, $exception);
        $this->assertSame($expectedMessage, $exception->getMessage());
        $this->assertArrayHasKey('code', $exception->getContext());
        $this->assertSame($expectedCode, $exception->getContext()['code']);
    }
}

// Concrete implementation of AbstractException for testing
final class ConcreteTestException extends AbstractException
{
    public function addTestContext(string $key, mixed $value): self
    {
        return $this->addContext($key, $value);
    }
}
