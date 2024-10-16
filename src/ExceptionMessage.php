<?php

declare(strict_types=1);

namespace KaririCode\Exception;

use KaririCode\Exception\Contract\ErrorMessage;

final class ExceptionMessage implements ErrorMessage
{
    public function __construct(
        private readonly string $code,
        private readonly string $message
    ) {
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
