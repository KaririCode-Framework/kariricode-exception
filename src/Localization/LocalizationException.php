<?php

declare(strict_types=1);

namespace KaririCode\Exception\Localization;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class LocalizationException extends AbstractException
{
    public static function missingTranslation(string $key, string $locale): self
    {
        return new self(new ExceptionMessage('MISSING_TRANSLATION', "Missing translation for key '{$key}' in locale '{$locale}'"));
    }

    public static function invalidLocale(string $locale): self
    {
        return new self(new ExceptionMessage('INVALID_LOCALE', "Invalid locale: {$locale}"));
    }
}
