<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Event;

use KaririCode\Exception\Event\EventException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class EventExceptionTest extends AbstractExceptionTest
{
    public function testListenerNotCallable(): void
    {
        $eventName = 'user.registered';
        $exception = EventException::listenerNotCallable($eventName);
        $this->assertExceptionStructure($exception, 'LISTENER_NOT_CALLABLE', "Event listener is not callable for event: {$eventName}");
    }

    public function testEventDispatchFailed(): void
    {
        $eventName = 'email.sent';
        $exception = EventException::eventDispatchFailed($eventName);
        $this->assertExceptionStructure($exception, 'EVENT_DISPATCH_FAILED', "Failed to dispatch event: {$eventName}");
    }
}
