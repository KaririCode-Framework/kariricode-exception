<?php

declare(strict_types=1);

namespace KaririCode\Exception\Middleware;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class MiddlewareException extends AbstractException
{
    public static function invalidMiddleware(string $middlewareName): self
    {
        return new self(new ExceptionMessage('INVALID_MIDDLEWARE', "Invalid middleware: {$middlewareName}"));
    }

    public static function middlewareExecutionFailed(string $middlewareName): self
    {
        return new self(new ExceptionMessage('MIDDLEWARE_EXECUTION_FAILED', "Execution failed for middleware: {$middlewareName}"));
    }
}
