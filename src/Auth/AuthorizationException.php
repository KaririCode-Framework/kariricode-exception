<?php

declare(strict_types=1);

namespace KaririCode\Exception\Auth;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class AuthorizationException extends AbstractException
{
    public static function insufficientPermissions(string $action): self
    {
        return new self(new ExceptionMessage('INSUFFICIENT_PERMISSIONS', "Insufficient permissions for action: {$action}"));
    }

    public static function roleRequired(string $role): self
    {
        return new self(new ExceptionMessage('ROLE_REQUIRED', "Required role not present: {$role}"));
    }
}
