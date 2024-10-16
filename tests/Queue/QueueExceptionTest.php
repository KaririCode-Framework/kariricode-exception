<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Queue;

use KaririCode\Exception\Queue\QueueException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class QueueExceptionTest extends AbstractExceptionTest
{
    public function testJobPushFailed(): void
    {
        $jobClass = 'App\Jobs\SendEmailJob';
        $exception = QueueException::jobPushFailed($jobClass);
        $this->assertExceptionStructure($exception, 'JOB_PUSH_FAILED', "Failed to push job to queue: {$jobClass}");
    }

    public function testJobProcessingFailed(): void
    {
        $jobId = 'job_123456';
        $exception = QueueException::jobProcessingFailed($jobId);
        $this->assertExceptionStructure($exception, 'JOB_PROCESSING_FAILED', "Failed to process job: {$jobId}");
    }

    public function testQueueConnectionFailed(): void
    {
        $connection = 'redis';
        $exception = QueueException::queueConnectionFailed($connection);
        $this->assertExceptionStructure($exception, 'QUEUE_CONNECTION_FAILED', "Failed to connect to queue: {$connection}");
    }
}
