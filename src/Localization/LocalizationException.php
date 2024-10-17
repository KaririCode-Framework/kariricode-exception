<?php

declare(strict_types=1);

namespace KaririCode\Exception\Localization;

use KaririCode\Exception\AbstractException;

final class LocalizationException extends AbstractException
{
    private const CODE_MISSING_TRANSLATION = 2001;
    private const CODE_INVALID_LOCALE = 2002;

    public static function missingTranslation(string $key, string $locale): self
    {
        return self::createException(
            self::CODE_MISSING_TRANSLATION,
            'MISSING_TRANSLATION',
            "Missing translation for key '{$key}' in locale '{$locale}'"
        );
    }

    public static function invalidLocale(string $locale): self
    {
        return self::createException(
            self::CODE_INVALID_LOCALE,
            'INVALID_LOCALE',
            "Invalid locale: {$locale}"
        );
    }
}
