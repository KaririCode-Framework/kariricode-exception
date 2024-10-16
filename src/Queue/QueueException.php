<?php

declare(strict_types=1);

namespace KaririCode\Exception\Queue;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class QueueException extends AbstractException
{
    private const CODE_JOB_PUSH_FAILED = 2301;
    private const CODE_JOB_PROCESSING_FAILED = 2302;
    private const CODE_QUEUE_CONNECTION_FAILED = 2303;

    public static function jobPushFailed(string $jobClass): self
    {
        return new self(new ExceptionMessage(
            self::CODE_JOB_PUSH_FAILED,
            'JOB_PUSH_FAILED',
            "Failed to push job to queue: {$jobClass}"
        ));
    }

    public static function jobProcessingFailed(string $jobId): self
    {
        return new self(new ExceptionMessage(
            self::CODE_JOB_PROCESSING_FAILED,
            'JOB_PROCESSING_FAILED',
            "Failed to process job: {$jobId}"
        ));
    }

    public static function queueConnectionFailed(string $connection): self
    {
        return new self(new ExceptionMessage(
            self::CODE_QUEUE_CONNECTION_FAILED,
            'QUEUE_CONNECTION_FAILED',
            "Failed to connect to queue: {$connection}"
        ));
    }
}
