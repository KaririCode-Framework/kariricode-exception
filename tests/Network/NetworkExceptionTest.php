<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Network;

use KaririCode\Exception\Network\NetworkException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class NetworkExceptionTest extends AbstractExceptionTest
{
    public function testConnectionFailed(): void
    {
        $host = 'example.com';
        $exception = NetworkException::connectionFailed($host);
        $this->assertExceptionStructure($exception, 'CONNECTION_FAILED', "Failed to connect to host: {$host}");
    }

    public function testTimeout(): void
    {
        $operation = 'HTTP request';
        $exception = NetworkException::timeout($operation);
        $this->assertExceptionStructure($exception, 'TIMEOUT', "Network operation timed out: {$operation}");
    }
}
