<?php

declare(strict_types=1);

namespace KaririCode\Exception;

use KaririCode\Exception\Contract\ErrorMessage;

final class ExceptionMessage implements ErrorMessage
{
    public function __construct(
        private readonly int $code,
        private readonly string $errorCode,
        private readonly string $message
    ) {
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
