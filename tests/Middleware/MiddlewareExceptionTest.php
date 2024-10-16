<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Middleware;

use KaririCode\Exception\Middleware\MiddlewareException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class MiddlewareExceptionTest extends AbstractExceptionTest
{
    public function testInvalidMiddleware(): void
    {
        $middlewareName = 'AuthMiddleware';
        $exception = MiddlewareException::invalidMiddleware($middlewareName);
        $this->assertExceptionStructure($exception, 'INVALID_MIDDLEWARE', "Invalid middleware: {$middlewareName}");
    }

    public function testMiddlewareExecutionFailed(): void
    {
        $middlewareName = 'RateLimitMiddleware';
        $exception = MiddlewareException::middlewareExecutionFailed($middlewareName);
        $this->assertExceptionStructure($exception, 'MIDDLEWARE_EXECUTION_FAILED', "Execution failed for middleware: {$middlewareName}");
    }
}
