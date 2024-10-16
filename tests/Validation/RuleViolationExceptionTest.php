<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Validation;

use KaririCode\Exception\Validation\RuleViolationException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class RuleViolationExceptionTest extends AbstractExceptionTest
{
    public function testCreate(): void
    {
        $rule = 'email';
        $field = 'user_email';
        $exception = RuleViolationException::create($rule, $field);
        $this->assertExceptionStructure($exception, 'RULE_VIOLATION', "Validation rule '{$rule}' violated for field '{$field}'");
    }
}
