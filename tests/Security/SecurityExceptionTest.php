<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Security;

use KaririCode\Exception\Security\SecurityException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class SecurityExceptionTest extends AbstractExceptionTest
{
    public function testUnauthorized(): void
    {
        $exception = SecurityException::unauthorized();
        $this->assertExceptionStructure($exception, 'UNAUTHORIZED', 'Unauthorized access');
    }

    public function testCsrfTokenMismatch(): void
    {
        $exception = SecurityException::csrfTokenMismatch();
        $this->assertExceptionStructure($exception, 'CSRF_TOKEN_MISMATCH', 'CSRF token mismatch');
    }

    public function testRateLimitExceeded(): void
    {
        $exception = SecurityException::rateLimitExceeded();
        $this->assertExceptionStructure($exception, 'RATE_LIMIT_EXCEEDED', 'Rate limit exceeded');
    }
}
