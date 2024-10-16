<?php

declare(strict_types=1);

namespace KaririCode\Exception\Network;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class HttpException extends AbstractException
{
    public static function clientError(int $statusCode): self
    {
        return new self(new ExceptionMessage('HTTP_CLIENT_ERROR', "HTTP client error with status code: {$statusCode}"));
    }

    public static function serverError(int $statusCode): self
    {
        return new self(new ExceptionMessage('HTTP_SERVER_ERROR', "HTTP server error with status code: {$statusCode}"));
    }
}
