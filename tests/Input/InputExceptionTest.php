<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Input;

use KaririCode\Exception\Input\InputException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class InputExceptionTest extends AbstractExceptionTest
{
    public function testInvalidFormat(): void
    {
        $field = 'email';
        $exception = InputException::invalidFormat($field);
        $this->assertExceptionStructure($exception, 'INVALID_FORMAT', "Invalid format for field: {$field}");
    }

    public function testMissingRequired(): void
    {
        $field = 'username';
        $exception = InputException::missingRequired($field);
        $this->assertExceptionStructure($exception, 'MISSING_REQUIRED', "Missing required field: {$field}");
    }

    public function testExceedsMaxLength(): void
    {
        $field = 'description';
        $maxLength = 255;
        $exception = InputException::exceedsMaxLength($field, $maxLength);
        $this->assertExceptionStructure($exception, 'EXCEEDS_MAX_LENGTH', "Field '{$field}' exceeds maximum length of {$maxLength}");
    }
}
