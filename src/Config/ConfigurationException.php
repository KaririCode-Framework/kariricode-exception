<?php

declare(strict_types=1);

namespace KaririCode\Exception\Config;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class ConfigurationException extends AbstractException
{
    private const CODE_MISSING_KEY = 1301;
    private const CODE_INVALID_VALUE = 1302;
    private const CODE_ENVIRONMENT_NOT_SET = 1303;

    public static function missingKey(string $key): self
    {
        return new self(new ExceptionMessage(
            self::CODE_MISSING_KEY,
            'MISSING_CONFIG_KEY',
            "Missing configuration key: {$key}"
        ));
    }

    public static function invalidValue(string $key, mixed $value): self
    {
        return new self(new ExceptionMessage(
            self::CODE_INVALID_VALUE,
            'INVALID_CONFIG_VALUE',
            "Invalid configuration value for key '{$key}': " . var_export($value, true)
        ));
    }

    public static function environmentNotSet(string $envVar): self
    {
        return new self(new ExceptionMessage(
            self::CODE_ENVIRONMENT_NOT_SET,
            'ENVIRONMENT_NOT_SET',
            "Environment variable not set: {$envVar}"
        ));
    }
}
