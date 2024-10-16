<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Validation;

use KaririCode\Exception\Validation\ValidationException;
use KaririCode\Exception\Tests\AbstractExceptionTest;
use KaririCode\Exception\ExceptionMessage;

final class ValidationExceptionTest extends AbstractExceptionTest
{
    public function testCreate(): void
    {
        $exception = ValidationException::create();
        $this->assertExceptionStructure($exception, 'VALIDATION_FAILED', 'Validation failed');
    }

    public function testAddValidationError(): void
    {
        $exception = ValidationException::create();
        $errorMessage = new ExceptionMessage('FIELD_ERROR', 'Field has an error');
        $exception->addError('field_name', $errorMessage);

        $errors = $exception->getValidationErrors();
        $this->assertArrayHasKey('field_name', $errors);
        $this->assertCount(1, $errors['field_name']);
        $this->assertSame($errorMessage, $errors['field_name'][0]);
    }
}
