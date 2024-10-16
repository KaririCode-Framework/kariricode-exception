<?php

declare(strict_types=1);

namespace KaririCode\Exception\Event;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class EventException extends AbstractException
{
    private const CODE_LISTENER_NOT_CALLABLE = 1601;
    private const CODE_EVENT_DISPATCH_FAILED = 1602;

    public static function listenerNotCallable(string $eventName): self
    {
        return new self(new ExceptionMessage(
            self::CODE_LISTENER_NOT_CALLABLE,
            'LISTENER_NOT_CALLABLE',
            "Event listener is not callable for event: {$eventName}"
        ));
    }

    public static function eventDispatchFailed(string $eventName): self
    {
        return new self(new ExceptionMessage(
            self::CODE_EVENT_DISPATCH_FAILED,
            'EVENT_DISPATCH_FAILED',
            "Failed to dispatch event: {$eventName}"
        ));
    }
}
