<?php

declare(strict_types=1);

namespace KaririCode\Exception;

use KaririCode\Exception\Contract\ErrorMessage;
use KaririCode\Exception\Contract\Throwable;

abstract class AbstractException extends \Exception implements Throwable
{
    protected array $context = [];

    public function __construct(ErrorMessage $errorMessage, ?\Throwable $previous = null, array $context = [])
    {

        $this->context = array_merge(['code' => $errorMessage->getCode()], $context);

        parent::__construct($errorMessage->getMessage(), 0, $previous);
    }

    public function getContext(): array
    {
        return $this->context;
    }

    protected function addContext(string $key, mixed $value): self
    {
        $this->context[$key] = $value;

        return $this;
    }
}
