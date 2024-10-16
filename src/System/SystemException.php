<?php

declare(strict_types=1);

namespace KaririCode\Exception\System;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class SystemException extends AbstractException
{
    public static function resourceUnavailable(string $resource): self
    {
        return new self(new ExceptionMessage('RESOURCE_UNAVAILABLE', "System resource unavailable: {$resource}"));
    }

    public static function environmentError(string $details): self
    {
        return new self(new ExceptionMessage('ENVIRONMENT_ERROR', "Environment error: {$details}"));
    }

    public static function extensionNotLoaded(string $extension): self
    {
        return new self(new ExceptionMessage('EXTENSION_NOT_LOADED', "PHP extension not loaded: {$extension}"));
    }
}
