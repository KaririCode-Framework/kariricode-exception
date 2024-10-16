<?php

declare(strict_types=1);

namespace KaririCode\Exception\Queue;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class QueueException extends AbstractException
{
    public static function jobPushFailed(string $jobClass): self
    {
        return new self(new ExceptionMessage('JOB_PUSH_FAILED', "Failed to push job to queue: {$jobClass}"));
    }

    public static function jobProcessingFailed(string $jobId): self
    {
        return new self(new ExceptionMessage('JOB_PROCESSING_FAILED', "Failed to process job: {$jobId}"));
    }

    public static function queueConnectionFailed(string $connection): self
    {
        return new self(new ExceptionMessage('QUEUE_CONNECTION_FAILED', "Failed to connect to queue: {$connection}"));
    }
}
