<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Database;

use KaririCode\Exception\Database\DatabaseException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class DatabaseExceptionTest extends AbstractExceptionTest
{
    public function testConnectionError(): void
    {
        $details = 'Connection refused';
        $exception = DatabaseException::connectionError($details);
        $this->assertExceptionStructure($exception, 'DB_CONNECTION_ERROR', "Database connection error: {$details}");
    }

    public function testQueryError(): void
    {
        $query = 'SELECT * FROM users';
        $error = 'Table "users" not found';
        $exception = DatabaseException::queryError($query, $error);
        $this->assertExceptionStructure($exception, 'DB_QUERY_ERROR', "Database query error: {$error}");
    }

    public function testDeadlockDetected(): void
    {
        $exception = DatabaseException::deadlockDetected();
        $this->assertExceptionStructure($exception, 'DB_DEADLOCK', 'Database deadlock detected');
    }
}
