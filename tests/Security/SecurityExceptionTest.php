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
        $this->assertExceptionStructure(
            $exception,
            'UNAUTHORIZED',
            'Unauthorized access',
            2701
        );
    }

    public function testCsrfTokenMismatch(): void
    {
        $exception = SecurityException::csrfTokenMismatch();
        $this->assertExceptionStructure(
            $exception,
            'CSRF_TOKEN_MISMATCH',
            'CSRF token mismatch',
            2702
        );
    }

    public function testRateLimitExceeded(): void
    {
        $exception = SecurityException::rateLimitExceeded();
        $this->assertExceptionStructure(
            $exception,
            'RATE_LIMIT_EXCEEDED',
            'Rate limit exceeded',
            2703
        );
    }
}
