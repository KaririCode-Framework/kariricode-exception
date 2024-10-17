<?php

declare(strict_types=1);

namespace KaririCode\Exception\Validation;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\Contract\ErrorMessage;

final class ValidationException extends AbstractException
{
    private const CODE_VALIDATION_FAILED = 3101;

    private array $validationErrors = [];

    public static function create(): self
    {
        return self::createException(
            self::CODE_VALIDATION_FAILED,
            'VALIDATION_FAILED',
            'Validation failed'
        );
    }

    public function addError(string $field, ErrorMessage $errorMessage): self
    {
        $this->validationErrors[$field][] = $errorMessage;

        return $this;
    }

    public function getValidationErrors(): array
    {
        return $this->validationErrors;
    }
}
