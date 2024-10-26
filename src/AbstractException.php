<?php

declare(strict_types=1);

namespace KaririCode\Exception;

use KaririCode\Exception\Contract\ErrorMessage;
use KaririCode\Exception\Contract\Throwable;

abstract class AbstractException extends \Exception implements Throwable
{
    protected array $context = [];
    private string $errorCode;

    public function __construct(ErrorMessage $errorMessage, ?\Throwable $previous = null, array $context = [])
    {
        $this->errorCode = $errorMessage->getErrorCode();
        $this->context = array_merge(['code' => $this->errorCode], $context);
        parent::__construct($errorMessage->getMessage(), $errorMessage->getCode(), $previous);
    }

    public function getContext(): array
    {
        return $this->context;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    protected function addContext(string $key, mixed $value): self
    {
        $this->context[$key] = $value;

        return $this;
    }

    protected static function createException(int $code, string $errorCode, string $message, ?\Throwable $previous = null): self
    {
        return new static(new ExceptionMessage($code, $errorCode, $message), $previous);
    }
}
