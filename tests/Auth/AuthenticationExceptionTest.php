<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Auth;

use KaririCode\Exception\Auth\AuthenticationException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class AuthenticationExceptionTest extends AbstractExceptionTest
{
    public function testInvalidCredentials(): void
    {
        $exception = AuthenticationException::invalidCredentials();
        $this->assertExceptionStructure($exception, 'INVALID_CREDENTIALS', 'Invalid credentials provided', 1001);
    }

    public function testAccountLocked(): void
    {
        $exception = AuthenticationException::accountLocked();
        $this->assertExceptionStructure($exception, 'ACCOUNT_LOCKED', 'Account is locked', 1002);
    }

    public function testTwoFactorRequired(): void
    {
        $exception = AuthenticationException::twoFactorRequired();
        $this->assertExceptionStructure($exception, 'TWO_FACTOR_REQUIRED', 'Two-factor authentication is required', 1003);
    }
}
