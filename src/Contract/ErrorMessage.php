<?php

declare(strict_types=1);

namespace KaririCode\Exception\Contract;

interface ErrorMessage
{
    public function getCode(): int;

    public function getErrorCode(): string;

    public function getMessage(): string;
}
