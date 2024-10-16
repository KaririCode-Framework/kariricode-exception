<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\ExternalService;

use KaririCode\Exception\ExternalService\ExternalServiceException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class ExternalServiceExceptionTest extends AbstractExceptionTest
{
    public function testApiError(): void
    {
        $service = 'PaymentGateway';
        $error = 'Invalid API key';
        $exception = ExternalServiceException::apiError($service, $error);
        $this->assertExceptionStructure($exception, 'API_ERROR', "Error from external service '{$service}': {$error}");
    }

    public function testServiceUnavailable(): void
    {
        $service = 'EmailService';
        $exception = ExternalServiceException::serviceUnavailable($service);
        $this->assertExceptionStructure($exception, 'SERVICE_UNAVAILABLE', "External service unavailable: {$service}");
    }

    public function testInvalidResponse(): void
    {
        $service = 'WeatherAPI';
        $exception = ExternalServiceException::invalidResponse($service);
        $this->assertExceptionStructure($exception, 'INVALID_RESPONSE', "Invalid response from external service: {$service}");
    }
}
