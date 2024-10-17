<?php

declare(strict_types=1);

namespace KaririCode\Exception\Network;

use KaririCode\Exception\AbstractException;

final class HttpException extends AbstractException
{
    private const CODE_CLIENT_ERROR = 2203;
    private const CODE_SERVER_ERROR = 2204;

    public static function clientError(int $statusCode): self
    {
        return self::createException(
            self::CODE_CLIENT_ERROR,
            'HTTP_CLIENT_ERROR',
            "HTTP client error with status code: {$statusCode}"
        );
    }

    public static function serverError(int $statusCode): self
    {
        return self::createException(
            self::CODE_SERVER_ERROR,
            'HTTP_SERVER_ERROR',
            "HTTP server error with status code: {$statusCode}"
        );
    }
}
