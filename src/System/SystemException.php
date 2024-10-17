<?php

declare(strict_types=1);

namespace KaririCode\Exception\System;

use KaririCode\Exception\AbstractException;

final class SystemException extends AbstractException
{
    private const CODE_RESOURCE_UNAVAILABLE = 2901;
    private const CODE_ENVIRONMENT_ERROR = 2902;
    private const CODE_EXTENSION_NOT_LOADED = 2903;

    public static function resourceUnavailable(string $resource): self
    {
        return self::createException(
            self::CODE_RESOURCE_UNAVAILABLE,
            'RESOURCE_UNAVAILABLE',
            "System resource unavailable: {$resource}"
        );
    }

    public static function environmentError(string $details): self
    {
        return self::createException(
            self::CODE_ENVIRONMENT_ERROR,
            'ENVIRONMENT_ERROR',
            "Environment error: {$details}"
        );
    }

    public static function extensionNotLoaded(string $extension): self
    {
        return self::createException(
            self::CODE_EXTENSION_NOT_LOADED,
            'EXTENSION_NOT_LOADED',
            "PHP extension not loaded: {$extension}"
        );
    }
}
