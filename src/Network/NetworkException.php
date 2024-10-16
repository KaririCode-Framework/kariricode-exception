<?php

declare(strict_types=1);

namespace KaririCode\Exception\Network;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class NetworkException extends AbstractException
{
    public static function connectionFailed(string $host): self
    {
        return new self(new ExceptionMessage('CONNECTION_FAILED', "Failed to connect to host: {$host}"));
    }

    public static function timeout(string $operation): self
    {
        return new self(new ExceptionMessage('TIMEOUT', "Network operation timed out: {$operation}"));
    }
}
