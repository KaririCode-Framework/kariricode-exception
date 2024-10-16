<?php

declare(strict_types=1);

namespace KaririCode\Exception\Validation;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class RuleViolationException extends AbstractException
{
    private const CODE_RULE_VIOLATION = 3102;

    public static function create(string $rule, string $field): self
    {
        return new self(new ExceptionMessage(
            self::CODE_RULE_VIOLATION,
            'RULE_VIOLATION',
            "Validation rule '{$rule}' violated for field '{$field}'"
        ));
    }
}
