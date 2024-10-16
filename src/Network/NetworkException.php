<?php

declare(strict_types=1);

namespace KaririCode\Exception\Network;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class NetworkException extends AbstractException
{
    private const CODE_CONNECTION_FAILED = 2201;
    private const CODE_TIMEOUT = 2202;

    public static function connectionFailed(string $host): self
    {
        return new self(new ExceptionMessage(
            self::CODE_CONNECTION_FAILED,
            'CONNECTION_FAILED',
            "Failed to connect to host: {$host}"
        ));
    }

    public static function timeout(string $operation): self
    {
        return new self(new ExceptionMessage(
            self::CODE_TIMEOUT,
            'TIMEOUT',
            "Network operation timed out: {$operation}"
        ));
    }
}
