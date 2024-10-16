<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Routing;

use KaririCode\Exception\Routing\RoutingException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class RoutingExceptionTest extends AbstractExceptionTest
{
    public function testRouteNotFound(): void
    {
        $uri = '/unknown/path';
        $exception = RoutingException::routeNotFound($uri);
        $this->assertExceptionStructure(
            $exception,
            'ROUTE_NOT_FOUND',
            "Route not found for URI: {$uri}",
            2401
        );
    }

    public function testMethodNotAllowed(): void
    {
        $method = 'POST';
        $uri = '/get-only-path';
        $exception = RoutingException::methodNotAllowed($method, $uri);
        $this->assertExceptionStructure(
            $exception,
            'METHOD_NOT_ALLOWED',
            "Method {$method} not allowed for URI: {$uri}",
            2402
        );
    }
}
