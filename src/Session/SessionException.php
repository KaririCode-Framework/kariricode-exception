<?php

declare(strict_types=1);

namespace KaririCode\Exception\Session;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class SessionException extends AbstractException
{
    private const CODE_SESSION_START_FAILED = 2801;
    private const CODE_INVALID_SESSION_ID = 2802;

    public static function sessionStartFailed(): self
    {
        return new self(new ExceptionMessage(
            self::CODE_SESSION_START_FAILED,
            'SESSION_START_FAILED',
            'Failed to start session'
        ));
    }

    public static function invalidSessionId(): self
    {
        return new self(new ExceptionMessage(
            self::CODE_INVALID_SESSION_ID,
            'INVALID_SESSION_ID',
            'Invalid session ID'
        ));
    }
}
