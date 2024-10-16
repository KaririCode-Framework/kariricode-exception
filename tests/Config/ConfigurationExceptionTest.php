<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Config;

use KaririCode\Exception\Config\ConfigurationException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class ConfigurationExceptionTest extends AbstractExceptionTest
{
    public function testMissingKey(): void
    {
        $key = 'database.host';
        $exception = ConfigurationException::missingKey($key);
        $this->assertExceptionStructure($exception, 'MISSING_CONFIG_KEY', "Missing configuration key: {$key}");
    }

    public function testInvalidValue(): void
    {
        $key = 'app.debug';
        $value = 'not_a_boolean';
        $exception = ConfigurationException::invalidValue($key, $value);
        $this->assertExceptionStructure($exception, 'INVALID_CONFIG_VALUE', "Invalid configuration value for key '{$key}': " . var_export($value, true));
    }

    public function testEnvironmentNotSet(): void
    {
        $envVar = 'APP_KEY';
        $exception = ConfigurationException::environmentNotSet($envVar);
        $this->assertExceptionStructure($exception, 'ENVIRONMENT_NOT_SET', "Environment variable not set: {$envVar}");
    }
}
