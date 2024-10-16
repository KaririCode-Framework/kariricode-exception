<?php

declare(strict_types=1);

namespace KaririCode\Exception\Security;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class SecurityException extends AbstractException
{
    public static function unauthorized(): self
    {
        return new self(new ExceptionMessage('UNAUTHORIZED', 'Unauthorized access'));
    }

    public static function csrfTokenMismatch(): self
    {
        return new self(new ExceptionMessage('CSRF_TOKEN_MISMATCH', 'CSRF token mismatch'));
    }

    public static function rateLimitExceeded(): self
    {
        return new self(new ExceptionMessage('RATE_LIMIT_EXCEEDED', 'Rate limit exceeded'));
    }
}
