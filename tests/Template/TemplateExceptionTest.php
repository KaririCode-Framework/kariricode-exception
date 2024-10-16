<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Template;

use KaririCode\Exception\Template\TemplateException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class TemplateExceptionTest extends AbstractExceptionTest
{
    public function testTemplateNotFound(): void
    {
        $templateName = 'user/profile.html.twig';
        $exception = TemplateException::templateNotFound($templateName);
        $this->assertExceptionStructure($exception, 'TEMPLATE_NOT_FOUND', "Template not found: {$templateName}");
    }

    public function testRenderingFailed(): void
    {
        $templateName = 'email/welcome.html.twig';
        $exception = TemplateException::renderingFailed($templateName);
        $this->assertExceptionStructure($exception, 'RENDERING_FAILED', "Failed to render template: {$templateName}");
    }
}
