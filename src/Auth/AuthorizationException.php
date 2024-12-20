<?php

declare(strict_types=1);

namespace KaririCode\Exception\Auth;

use KaririCode\Exception\AbstractException;

final class AuthorizationException extends AbstractException
{
    private const CODE_INSUFFICIENT_PERMISSIONS = 1101;
    private const CODE_ROLE_REQUIRED = 1102;

    public static function insufficientPermissions(string $action): self
    {
        return self::createException(
            self::CODE_INSUFFICIENT_PERMISSIONS,
            'INSUFFICIENT_PERMISSIONS',
            "Insufficient permissions for action: {$action}"
        );
    }

    public static function roleRequired(string $role): self
    {
        return self::createException(
            self::CODE_ROLE_REQUIRED,
            'ROLE_REQUIRED',
            "Required role not present: {$role}"
        );
    }
}
