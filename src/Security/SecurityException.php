<?php

declare(strict_types=1);

namespace KaririCode\Exception\Security;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class SecurityException extends AbstractException
{
    private const CODE_UNAUTHORIZED = 2701;
    private const CODE_CSRF_TOKEN_MISMATCH = 2702;
    private const CODE_RATE_LIMIT_EXCEEDED = 2703;

    public static function unauthorized(): self
    {
        return new self(new ExceptionMessage(
            self::CODE_UNAUTHORIZED,
            'UNAUTHORIZED',
            'Unauthorized access'
        ));
    }

    public static function csrfTokenMismatch(): self
    {
        return new self(new ExceptionMessage(
            self::CODE_CSRF_TOKEN_MISMATCH,
            'CSRF_TOKEN_MISMATCH',
            'CSRF token mismatch'
        ));
    }

    public static function rateLimitExceeded(): self
    {
        return new self(new ExceptionMessage(
            self::CODE_RATE_LIMIT_EXCEEDED,
            'RATE_LIMIT_EXCEEDED',
            'Rate limit exceeded'
        ));
    }
}
