<?php

declare(strict_types=1);

namespace KaririCode\Exception\Auth;

use KaririCode\Exception\AbstractException;

final class AuthenticationException extends AbstractException
{
    private const CODE_INVALID_CREDENTIALS = 1001;
    private const CODE_ACCOUNT_LOCKED = 1002;
    private const CODE_TWO_FACTOR_REQUIRED = 1003;

    public static function invalidCredentials(): self
    {
        return self::createException(
            self::CODE_INVALID_CREDENTIALS,
            'INVALID_CREDENTIALS',
            'Invalid credentials provided'
        );
    }

    public static function accountLocked(): self
    {
        return self::createException(
            self::CODE_ACCOUNT_LOCKED,
            'ACCOUNT_LOCKED',
            'Account is locked'
        );
    }

    public static function twoFactorRequired(): self
    {
        return self::createException(
            self::CODE_TWO_FACTOR_REQUIRED,
            'TWO_FACTOR_REQUIRED',
            'Two-factor authentication is required'
        );
    }
}
