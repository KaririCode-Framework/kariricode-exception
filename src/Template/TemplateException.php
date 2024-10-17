<?php

declare(strict_types=1);

namespace KaririCode\Exception\Template;

use KaririCode\Exception\AbstractException;

final class TemplateException extends AbstractException
{
    private const CODE_TEMPLATE_NOT_FOUND = 3001;
    private const CODE_RENDERING_FAILED = 3002;

    public static function templateNotFound(string $templateName): self
    {
        return self::createException(
            self::CODE_TEMPLATE_NOT_FOUND,
            'TEMPLATE_NOT_FOUND',
            "Template not found: {$templateName}"
        );
    }

    public static function renderingFailed(string $templateName): self
    {
        return self::createException(
            self::CODE_RENDERING_FAILED,
            'RENDERING_FAILED',
            "Failed to render template: {$templateName}"
        );
    }
}
