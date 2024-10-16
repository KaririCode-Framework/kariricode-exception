<?php

declare(strict_types=1);

namespace KaririCode\Exception\Routing;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class RoutingException extends AbstractException
{
    public static function routeNotFound(string $uri): self
    {
        return new self(new ExceptionMessage('ROUTE_NOT_FOUND', "Route not found for URI: {$uri}"));
    }

    public static function methodNotAllowed(string $method, string $uri): self
    {
        return new self(new ExceptionMessage('METHOD_NOT_ALLOWED', "Method {$method} not allowed for URI: {$uri}"));
    }
}
