<?php

declare(strict_types=1);

namespace KaririCode\Exception\Contract;

interface ErrorMessage
{
    public function getCode(): string;

    public function getMessage(): string;
}
