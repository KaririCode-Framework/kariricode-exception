<?php

declare(strict_types=1);

namespace KaririCode\Exception\Routing;

use KaririCode\Exception\AbstractException;

final class RoutingException extends AbstractException
{
    private const CODE_ROUTE_NOT_FOUND = 2401;
    private const CODE_METHOD_NOT_ALLOWED = 2402;

    public static function routeNotFound(string $uri): self
    {
        return self::createException(
            self::CODE_ROUTE_NOT_FOUND,
            'ROUTE_NOT_FOUND',
            "Route not found for URI: {$uri}"
        );
    }

    public static function methodNotAllowed(string $method, string $uri): self
    {
        return self::createException(
            self::CODE_METHOD_NOT_ALLOWED,
            'METHOD_NOT_ALLOWED',
            "Method {$method} not allowed for URI: {$uri}"
        );
    }
}
