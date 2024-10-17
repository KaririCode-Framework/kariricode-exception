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
        $this->assertExceptionStructure(
            $exception,
            'INVALID_FORMAT',
            "Invalid format for field: {$field}",
            1901
        );
    }

    public function testMissingRequired(): void
    {
        $field = 'username';
        $exception = InputException::missingRequired($field);
        $this->assertExceptionStructure(
            $exception,
            'MISSING_REQUIRED',
            "Missing required field: {$field}",
            1902
        );
    }

    public function testExceedsMaxLength(): void
    {
        $field = 'description';
        $maxLength = 255;
        $exception = InputException::exceedsMaxLength($field, $maxLength);
        $this->assertExceptionStructure(
            $exception,
            'EXCEEDS_MAX_LENGTH',
            "Field '{$field}' exceeds maximum length of {$maxLength}",
            1903
        );
    }

    public function testInvalidArgument(): void
    {
        $field = 'age';
        $value = 'not a number';
        $expectedType = 'integer';
        $exception = InputException::invalidArgument($field, $value, $expectedType);
        $this->assertExceptionStructure(
            $exception,
            'INVALID_ARGUMENT',
            "Invalid argument for field 'age'. Received value: 'not a number', expected type: integer",
            1904
        );
    }

    public function testBelowMinLength(): void
    {
        $field = 'password';
        $minLength = 8;
        $exception = InputException::belowMinLength($field, $minLength);
        $this->assertExceptionStructure(
            $exception,
            'BELOW_MIN_LENGTH',
            "Field '{$field}' is below minimum length of {$minLength}",
            1905
        );
    }

    public function testOutOfRange(): void
    {
        $field = 'rating';
        $min = 1;
        $max = 5;
        $exception = InputException::outOfRange($field, $min, $max);
        $this->assertExceptionStructure(
            $exception,
            'OUT_OF_RANGE',
            "Field '{$field}' is out of range. Must be between {$min} and {$max}",
            1906
        );
    }

    public function testInvalidType(): void
    {
        $field = 'count';
        $expectedType = 'integer';
        $exception = InputException::invalidType($field, $expectedType);
        $this->assertExceptionStructure(
            $exception,
            'INVALID_TYPE',
            "Field '{$field}' is of invalid type. Expected {$expectedType}",
            1907
        );
    }

    public function testInvalidOption(): void
    {
        $field = 'status';
        $validOptions = ['active', 'inactive', 'pending'];
        $exception = InputException::invalidOption($field, $validOptions);
        $this->assertExceptionStructure(
            $exception,
            'INVALID_OPTION',
            "Invalid option for field '{$field}'. Valid options are: active, inactive, pending",
            1908
        );
    }

    public function testDuplicateEntry(): void
    {
        $field = 'email';
        $value = 'test@example.com';
        $exception = InputException::duplicateEntry($field, $value);
        $this->assertExceptionStructure(
            $exception,
            'DUPLICATE_ENTRY',
            "Duplicate entry for field '{$field}' with value '{$value}'",
            1909
        );
    }

    public function testInvalidDate(): void
    {
        $field = 'birthdate';
        $format = 'Y-m-d';
        $exception = InputException::invalidDate($field, $format);
        $this->assertExceptionStructure(
            $exception,
            'INVALID_DATE',
            "Invalid date for field '{$field}'. Expected format: {$format}",
            1910
        );
    }

    public function testInvalidConfigParam(): void
    {
        $param = 'timeout';
        $value = -1;
        $expectedDescription = 'a positive integer';
        $exception = InputException::invalidConfigParam($param, $value, $expectedDescription);
        $this->assertExceptionStructure(
            $exception,
            'INVALID_CONFIG_PARAM',
            "Invalid configuration parameter '{$param}'. Received value: -1. Expected: {$expectedDescription}",
            1911
        );
    }
}
