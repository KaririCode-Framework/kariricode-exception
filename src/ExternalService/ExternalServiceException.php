<?php

declare(strict_types=1);

namespace KaririCode\Exception\ExternalService;

use KaririCode\Exception\AbstractException;

final class ExternalServiceException extends AbstractException
{
    private const CODE_API_ERROR = 1701;
    private const CODE_SERVICE_UNAVAILABLE = 1702;
    private const CODE_INVALID_RESPONSE = 1703;

    public static function apiError(string $service, string $error): self
    {
        return self::createException(
            self::CODE_API_ERROR,
            'API_ERROR',
            "Error from external service '{$service}': {$error}"
        );
    }

    public static function serviceUnavailable(string $service): self
    {
        return self::createException(
            self::CODE_SERVICE_UNAVAILABLE,
            'SERVICE_UNAVAILABLE',
            "External service unavailable: {$service}"
        );
    }

    public static function invalidResponse(string $service): self
    {
        return self::createException(
            self::CODE_INVALID_RESPONSE,
            'INVALID_RESPONSE',
            "Invalid response from external service: {$service}"
        );
    }
}
