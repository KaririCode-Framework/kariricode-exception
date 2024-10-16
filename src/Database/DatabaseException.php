<?php

declare(strict_types=1);

namespace KaririCode\Exception\Database;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class DatabaseException extends AbstractException
{
    private const CODE_CONNECTION_ERROR = 1501;
    private const CODE_QUERY_ERROR = 1502;
    private const CODE_DEADLOCK_DETECTED = 1503;

    public static function connectionError(string $details): self
    {
        return new self(new ExceptionMessage(
            self::CODE_CONNECTION_ERROR,
            'DB_CONNECTION_ERROR',
            "Database connection error: {$details}"
        ));
    }

    public static function queryError(string $query, string $error): self
    {
        return new self(new ExceptionMessage(
            self::CODE_QUERY_ERROR,
            'DB_QUERY_ERROR',
            "Database query error: {$error}"
        ));
    }

    public static function deadlockDetected(): self
    {
        return new self(new ExceptionMessage(
            self::CODE_DEADLOCK_DETECTED,
            'DB_DEADLOCK',
            'Database deadlock detected'
        ));
    }
}
