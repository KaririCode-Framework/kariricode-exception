<?php

declare(strict_types=1);

namespace KaririCode\Exception\Cache;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class CacheException extends AbstractException
{
    public static function itemNotFound(string $key): self
    {
        return new self(new ExceptionMessage('CACHE_ITEM_NOT_FOUND', "Cache item not found: {$key}"));
    }

    public static function storageError(string $details): self
    {
        return new self(new ExceptionMessage('CACHE_STORAGE_ERROR', "Cache storage error: {$details}"));
    }

    public static function invalidTtl(int $ttl): self
    {
        return new self(new ExceptionMessage('INVALID_TTL', "Invalid TTL value: {$ttl}"));
    }
}
