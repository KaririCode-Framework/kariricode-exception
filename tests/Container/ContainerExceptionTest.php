<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Container;

use KaririCode\Exception\Container\ContainerException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class ContainerExceptionTest extends AbstractExceptionTest
{
    public function testServiceNotFound(): void
    {
        $serviceId = 'App\Service\EmailService';
        $exception = ContainerException::serviceNotFound($serviceId);
        $this->assertExceptionStructure($exception, 'SERVICE_NOT_FOUND', "Service not found in container: {$serviceId}", 1401);
    }

    public function testCircularDependency(): void
    {
        $serviceId = 'App\Service\UserService';
        $exception = ContainerException::circularDependency($serviceId);
        $this->assertExceptionStructure($exception, 'CIRCULAR_DEPENDENCY', "Circular dependency detected for service: {$serviceId}", 1402);
    }
}
