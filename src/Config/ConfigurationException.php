<?php

declare(strict_types=1);

namespace KaririCode\Exception\Config;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class ConfigurationException extends AbstractException
{
    public static function missingKey(string $key): self
    {
        return new self(new ExceptionMessage('MISSING_CONFIG_KEY', "Missing configuration key: {$key}"));
    }

    public static function invalidValue(string $key, mixed $value): self
    {
        return new self(new ExceptionMessage('INVALID_CONFIG_VALUE', "Invalid configuration value for key '{$key}': " . var_export($value, true)));
    }

    public static function environmentNotSet(string $envVar): self
    {
        return new self(new ExceptionMessage('ENVIRONMENT_NOT_SET', "Environment variable not set: {$envVar}"));
    }
}
