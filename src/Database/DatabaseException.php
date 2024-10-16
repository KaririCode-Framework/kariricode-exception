<?php

declare(strict_types=1);

namespace KaririCode\Exception\Database;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class DatabaseException extends AbstractException
{
    public static function connectionError(string $details): self
    {
        return new self(new ExceptionMessage('DB_CONNECTION_ERROR', "Database connection error: {$details}"));
    }

    public static function queryError(string $query, string $error): self
    {
        return new self(new ExceptionMessage('DB_QUERY_ERROR', "Database query error: {$error}"));
    }

    public static function deadlockDetected(): self
    {
        return new self(new ExceptionMessage('DB_DEADLOCK', 'Database deadlock detected'));
    }
}
