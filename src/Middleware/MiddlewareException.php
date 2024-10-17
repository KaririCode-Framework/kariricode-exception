<?php

declare(strict_types=1);

namespace KaririCode\Exception\Middleware;

use KaririCode\Exception\AbstractException;

final class MiddlewareException extends AbstractException
{
    private const CODE_INVALID_MIDDLEWARE = 2101;
    private const CODE_MIDDLEWARE_EXECUTION_FAILED = 2102;

    public static function invalidMiddleware(string $middlewareName): self
    {
        return self::createException(
            self::CODE_INVALID_MIDDLEWARE,
            'INVALID_MIDDLEWARE',
            "Invalid middleware: {$middlewareName}"
        );
    }

    public static function middlewareExecutionFailed(string $middlewareName): self
    {
        return self::createException(
            self::CODE_MIDDLEWARE_EXECUTION_FAILED,
            'MIDDLEWARE_EXECUTION_FAILED',
            "Execution failed for middleware: {$middlewareName}"
        );
    }
}
