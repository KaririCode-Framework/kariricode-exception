<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Session;

use KaririCode\Exception\Session\SessionException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class SessionExceptionTest extends AbstractExceptionTest
{
    public function testSessionStartFailed(): void
    {
        $exception = SessionException::sessionStartFailed();
        $this->assertExceptionStructure($exception, 'SESSION_START_FAILED', 'Failed to start session');
    }

    public function testInvalidSessionId(): void
    {
        $exception = SessionException::invalidSessionId();
        $this->assertExceptionStructure($exception, 'INVALID_SESSION_ID', 'Invalid session ID');
    }
}
