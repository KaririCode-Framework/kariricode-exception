<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Cache;

use KaririCode\Exception\Cache\CacheException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class CacheExceptionTest extends AbstractExceptionTest
{
    public function testItemNotFound(): void
    {
        $key = 'user_profile_1';
        $exception = CacheException::itemNotFound($key);
        $this->assertExceptionStructure($exception, 'CACHE_ITEM_NOT_FOUND', "Cache item not found: {$key}");
    }

    public function testStorageError(): void
    {
        $details = 'Redis connection failed';
        $exception = CacheException::storageError($details);
        $this->assertExceptionStructure($exception, 'CACHE_STORAGE_ERROR', "Cache storage error: {$details}");
    }

    public function testInvalidTtl(): void
    {
        $ttl = -1;
        $exception = CacheException::invalidTtl($ttl);
        $this->assertExceptionStructure($exception, 'INVALID_TTL', "Invalid TTL value: {$ttl}");
    }
}
