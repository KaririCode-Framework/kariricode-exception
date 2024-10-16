<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Localization;

use KaririCode\Exception\Localization\LocalizationException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class LocalizationExceptionTest extends AbstractExceptionTest
{
    public function testMissingTranslation(): void
    {
        $key = 'welcome_message';
        $locale = 'fr_FR';
        $exception = LocalizationException::missingTranslation($key, $locale);
        $this->assertExceptionStructure(
            $exception,
            'MISSING_TRANSLATION',
            "Missing translation for key '{$key}' in locale '{$locale}'",
            2001
        );
    }

    public function testInvalidLocale(): void
    {
        $locale = 'invalid_locale';
        $exception = LocalizationException::invalidLocale($locale);
        $this->assertExceptionStructure(
            $exception,
            'INVALID_LOCALE',
            "Invalid locale: {$locale}",
            2002
        );
    }
}
