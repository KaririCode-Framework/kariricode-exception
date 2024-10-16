<?php

declare(strict_types=1);

namespace KaririCode\Exception\Session;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class SessionException extends AbstractException
{
    public static function sessionStartFailed(): self
    {
        return new self(new ExceptionMessage('SESSION_START_FAILED', 'Failed to start session'));
    }

    public static function invalidSessionId(): self
    {
        return new self(new ExceptionMessage('INVALID_SESSION_ID', 'Invalid session ID'));
    }
}
