<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Auth;

use KaririCode\Exception\Auth\AuthorizationException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class AuthorizationExceptionTest extends AbstractExceptionTest
{
    public function testInsufficientPermissions(): void
    {
        $action = 'delete_user';
        $exception = AuthorizationException::insufficientPermissions($action);
        $this->assertExceptionStructure($exception, 'INSUFFICIENT_PERMISSIONS', "Insufficient permissions for action: {$action}", 1101);
    }

    public function testRoleRequired(): void
    {
        $role = 'admin';
        $exception = AuthorizationException::roleRequired($role);
        $this->assertExceptionStructure($exception, 'ROLE_REQUIRED', "Required role not present: {$role}", 1102);
    }
}
