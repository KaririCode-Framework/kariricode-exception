<?php

declare(strict_types=1);

namespace KaririCode\Exception\Runtime;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class RuntimeException extends AbstractException
{
    public static function unexpectedValue(string $details): self
    {
        return new self(new ExceptionMessage('UNEXPECTED_VALUE', "Unexpected value: {$details}"));
    }

    public static function outOfMemory(): self
    {
        return new self(new ExceptionMessage('OUT_OF_MEMORY', 'Out of memory error'));
    }

    public static function classNotFound(string $className): self
    {
        return new self(new ExceptionMessage('CLASS_NOT_FOUND', "Class not found: {$className}"));
    }
}
