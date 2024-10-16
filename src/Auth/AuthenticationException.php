<?php

declare(strict_types=1);

namespace KaririCode\Exception\Auth;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class AuthenticationException extends AbstractException
{
    public static function invalidCredentials(): self
    {
        return new self(new ExceptionMessage('INVALID_CREDENTIALS', 'Invalid credentials provided'));
    }

    public static function accountLocked(): self
    {
        return new self(new ExceptionMessage('ACCOUNT_LOCKED', 'Account is locked'));
    }

    public static function twoFactorRequired(): self
    {
        return new self(new ExceptionMessage('TWO_FACTOR_REQUIRED', 'Two-factor authentication is required'));
    }
}
