<?php

declare(strict_types=1);

namespace KaririCode\Exception\Container;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class ContainerException extends AbstractException
{
    public static function serviceNotFound(string $serviceId): self
    {
        return new self(new ExceptionMessage('SERVICE_NOT_FOUND', "Service not found in container: {$serviceId}"));
    }

    public static function circularDependency(string $serviceId): self
    {
        return new self(new ExceptionMessage('CIRCULAR_DEPENDENCY', "Circular dependency detected for service: {$serviceId}"));
    }
}
