<?php

declare(strict_types=1);

namespace KaririCode\Exception\Input;

use KaririCode\Exception\AbstractException;

final class InputException extends AbstractException
{
    private const CODE_INVALID_FORMAT = 1901;
    private const CODE_MISSING_REQUIRED = 1902;
    private const CODE_EXCEEDS_MAX_LENGTH = 1903;
    private const CODE_INVALID_ARGUMENT = 1904;
    private const CODE_BELOW_MIN_LENGTH = 1905;
    private const CODE_OUT_OF_RANGE = 1906;
    private const CODE_INVALID_TYPE = 1907;
    private const CODE_INVALID_OPTION = 1908;
    private const CODE_DUPLICATE_ENTRY = 1909;
    private const CODE_INVALID_DATE = 1910;
    private const CODE_INVALID_CONFIG_PARAM = 1911;

    public static function invalidFormat(string $field): self
    {
        return self::createException(
            self::CODE_INVALID_FORMAT,
            'INVALID_FORMAT',
            "Invalid format for field: {$field}"
        );
    }

    public static function missingRequired(string $field): self
    {
        return self::createException(
            self::CODE_MISSING_REQUIRED,
            'MISSING_REQUIRED',
            "Missing required field: {$field}"
        );
    }

    public static function exceedsMaxLength(string $field, int $maxLength): self
    {
        return self::createException(
            self::CODE_EXCEEDS_MAX_LENGTH,
            'EXCEEDS_MAX_LENGTH',
            "Field '{$field}' exceeds maximum length of {$maxLength}"
        );
    }

    public static function invalidArgument(string $field, mixed $value, ?string $expectedType = null): self
    {
        $message = "Invalid argument for field '{$field}'. Received value: " . self::formatValue($value);
        if (null !== $expectedType) {
            $message .= ", expected type: {$expectedType}";
        }

        return self::createException(
            self::CODE_INVALID_ARGUMENT,
            'INVALID_ARGUMENT',
            $message
        );
    }

    public static function belowMinLength(string $field, int $minLength): self
    {
        return self::createException(
            self::CODE_BELOW_MIN_LENGTH,
            'BELOW_MIN_LENGTH',
            "Field '{$field}' is below minimum length of {$minLength}"
        );
    }

    public static function outOfRange(string $field, $min, $max): self
    {
        return self::createException(
            self::CODE_OUT_OF_RANGE,
            'OUT_OF_RANGE',
            "Field '{$field}' is out of range. Must be between {$min} and {$max}"
        );
    }

    public static function invalidType(string $field, string $expectedType): self
    {
        return self::createException(
            self::CODE_INVALID_TYPE,
            'INVALID_TYPE',
            "Field '{$field}' is of invalid type. Expected {$expectedType}"
        );
    }

    public static function invalidOption(string $field, array $validOptions): self
    {
        $optionsString = implode(', ', $validOptions);

        return self::createException(
            self::CODE_INVALID_OPTION,
            'INVALID_OPTION',
            "Invalid option for field '{$field}'. Valid options are: {$optionsString}"
        );
    }

    public static function duplicateEntry(string $field, $value): self
    {
        return self::createException(
            self::CODE_DUPLICATE_ENTRY,
            'DUPLICATE_ENTRY',
            "Duplicate entry for field '{$field}' with value '{$value}'"
        );
    }

    public static function invalidDate(string $field, string $format): self
    {
        return self::createException(
            self::CODE_INVALID_DATE,
            'INVALID_DATE',
            "Invalid date for field '{$field}'. Expected format: {$format}"
        );
    }

    public static function invalidConfigParam(string $param, mixed $value, string $expectedDescription): self
    {
        $message = "Invalid configuration parameter '{$param}'. " .
                   'Received value: ' . self::formatValue($value) .
                   ". Expected: {$expectedDescription}";

        return self::createException(
            self::CODE_INVALID_CONFIG_PARAM,
            'INVALID_CONFIG_PARAM',
            $message
        );
    }

    private static function formatValue(mixed $value): string
    {
        return match (true) {
            is_string($value) => "'{$value}'",
            is_bool($value) => $value ? 'true' : 'false',
            is_null($value) => 'null',
            is_array($value) => 'array',
            is_object($value) => get_class($value),
            default => (string) $value,
        };
    }
}
