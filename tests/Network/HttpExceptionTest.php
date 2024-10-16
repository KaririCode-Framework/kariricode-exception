<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Network;

use KaririCode\Exception\Network\HttpException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class HttpExceptionTest extends AbstractExceptionTest
{
    public function testClientError(): void
    {
        $statusCode = 404;
        $exception = HttpException::clientError($statusCode);
        $this->assertExceptionStructure($exception, 'HTTP_CLIENT_ERROR', "HTTP client error with status code: {$statusCode}");
    }

    public function testServerError(): void
    {
        $statusCode = 500;
        $exception = HttpException::serverError($statusCode);
        $this->assertExceptionStructure($exception, 'HTTP_SERVER_ERROR', "HTTP server error with status code: {$statusCode}");
    }
}
