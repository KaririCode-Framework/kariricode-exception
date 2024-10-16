<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\System;

use KaririCode\Exception\System\SystemException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class SystemExceptionTest extends AbstractExceptionTest
{
    public function testResourceUnavailable(): void
    {
        $resource = 'database';
        $exception = SystemException::resourceUnavailable($resource);
        $this->assertExceptionStructure($exception, 'RESOURCE_UNAVAILABLE', "System resource unavailable: {$resource}");
    }

    public function testEnvironmentError(): void
    {
        $details = 'Missing .env file';
        $exception = SystemException::environmentError($details);
        $this->assertExceptionStructure($exception, 'ENVIRONMENT_ERROR', "Environment error: {$details}");
    }

    public function testExtensionNotLoaded(): void
    {
        $extension = 'gd';
        $exception = SystemException::extensionNotLoaded($extension);
        $this->assertExceptionStructure($exception, 'EXTENSION_NOT_LOADED', "PHP extension not loaded: {$extension}");
    }
}
