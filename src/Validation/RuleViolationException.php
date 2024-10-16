<?php

declare(strict_types=1);

namespace KaririCode\Exception\Validation;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class RuleViolationException extends AbstractException
{
    public static function create(string $rule, string $field): self
    {
        return new self(new ExceptionMessage('RULE_VIOLATION', "Validation rule '{$rule}' violated for field '{$field}'"));
    }
}
