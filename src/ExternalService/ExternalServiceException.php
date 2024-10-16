<?php

declare(strict_types=1);

namespace KaririCode\Exception\ExternalService;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class ExternalServiceException extends AbstractException
{
    public static function apiError(string $service, string $error): self
    {
        return new self(new ExceptionMessage('API_ERROR', "Error from external service '{$service}': {$error}"));
    }

    public static function serviceUnavailable(string $service): self
    {
        return new self(new ExceptionMessage('SERVICE_UNAVAILABLE', "External service unavailable: {$service}"));
    }

    public static function invalidResponse(string $service): self
    {
        return new self(new ExceptionMessage('INVALID_RESPONSE', "Invalid response from external service: {$service}"));
    }
}
