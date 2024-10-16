<?php

declare(strict_types=1);

namespace KaririCode\Exception\Runtime;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class RuntimeException extends AbstractException
{
    private const CODE_UNEXPECTED_VALUE = 2501;
    private const CODE_OUT_OF_MEMORY = 2502;
    private const CODE_CLASS_NOT_FOUND = 2503;

    public static function unexpectedValue(string $details): self
    {
        return new self(new ExceptionMessage(
            self::CODE_UNEXPECTED_VALUE,
            'UNEXPECTED_VALUE',
            "Unexpected value: {$details}"
        ));
    }

    public static function outOfMemory(): self
    {
        return new self(new ExceptionMessage(
            self::CODE_OUT_OF_MEMORY,
            'OUT_OF_MEMORY',
            'Out of memory error'
        ));
    }

    public static function classNotFound(string $className): self
    {
        return new self(new ExceptionMessage(
            self::CODE_CLASS_NOT_FOUND,
            'CLASS_NOT_FOUND',
            "Class not found: {$className}"
        ));
    }
}
