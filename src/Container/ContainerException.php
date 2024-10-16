<?php

declare(strict_types=1);

namespace KaririCode\Exception\Container;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class ContainerException extends AbstractException
{
    private const CODE_SERVICE_NOT_FOUND = 1401;
    private const CODE_CIRCULAR_DEPENDENCY = 1402;

    public static function serviceNotFound(string $serviceId): self
    {
        return new self(new ExceptionMessage(
            self::CODE_SERVICE_NOT_FOUND,
            'SERVICE_NOT_FOUND',
            "Service not found in container: {$serviceId}"
        ));
    }

    public static function circularDependency(string $serviceId): self
    {
        return new self(new ExceptionMessage(
            self::CODE_CIRCULAR_DEPENDENCY,
            'CIRCULAR_DEPENDENCY',
            "Circular dependency detected for service: {$serviceId}"
        ));
    }
}
