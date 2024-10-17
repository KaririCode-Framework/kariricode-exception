<?php

declare(strict_types=1);

namespace KaririCode\Exception\Input;

use KaririCode\Exception\AbstractException;

final class InputException extends AbstractException
{
    private const CODE_INVALID_FORMAT = 1901;
    private const CODE_MISSING_REQUIRED = 1902;
    private const CODE_EXCEEDS_MAX_LENGTH = 1903;

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
}
