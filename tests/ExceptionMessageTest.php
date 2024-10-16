<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests;

use KaririCode\Exception\ExceptionMessage;
use PHPUnit\Framework\TestCase;

final class ExceptionMessageTest extends TestCase
{
    public function testExceptionMessageCreation(): void
    {
        $code = 9999;
        $errorCode = 'TEST_CODE';
        $message = 'Test message';
        $exceptionMessage = new ExceptionMessage($code, $errorCode, $message);

        $this->assertSame($code, $exceptionMessage->getCode());
        $this->assertSame($errorCode, $exceptionMessage->getErrorCode());
        $this->assertSame($message, $exceptionMessage->getMessage());
    }

    public function testExceptionMessageImmutability(): void
    {
        $exceptionMessage = new ExceptionMessage(9999, 'CODE', 'Message');

        $this->expectException(\Error::class);
        $reflectionProperty = new \ReflectionProperty($exceptionMessage, 'code');
        $reflectionProperty->setValue($exceptionMessage, 1234);
    }
}
