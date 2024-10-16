<?php

declare(strict_types=1);

namespace KaririCode\Exception\Input;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class InputException extends AbstractException
{
    public static function invalidFormat(string $field): self
    {
        return new self(new ExceptionMessage('INVALID_FORMAT', "Invalid format for field: {$field}"));
    }

    public static function missingRequired(string $field): self
    {
        return new self(new ExceptionMessage('MISSING_REQUIRED', "Missing required field: {$field}"));
    }

    public static function exceedsMaxLength(string $field, int $maxLength): self
    {
        return new self(new ExceptionMessage('EXCEEDS_MAX_LENGTH', "Field '{$field}' exceeds maximum length of {$maxLength}"));
    }
}
