<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Validation;

use KaririCode\Exception\ExceptionMessage;
use KaririCode\Exception\Tests\AbstractExceptionTest;
use KaririCode\Exception\Validation\ValidationException;

final class ValidationExceptionTest extends AbstractExceptionTest
{
    public function testCreate(): void
    {
        $exception = ValidationException::create();
        $this->assertExceptionStructure(
            $exception,
            'VALIDATION_FAILED',
            'Validation failed',
            3101
        );
    }

    public function testAddValidationError(): void
    {
        $exception = ValidationException::create();
        $errorMessage = new ExceptionMessage(
            3103,
            'FIELD_ERROR',
            'Field has an error'
        );
        $exception->addError('field_name', $errorMessage);

        $errors = $exception->getValidationErrors();
        $this->assertArrayHasKey('field_name', $errors);
        $this->assertCount(1, $errors['field_name']);
        $this->assertSame($errorMessage, $errors['field_name'][0]);
    }
}
