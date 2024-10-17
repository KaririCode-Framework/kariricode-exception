<?php

declare(strict_types=1);

namespace KaririCode\Exception\Cache;

use KaririCode\Exception\AbstractException;

final class CacheException extends AbstractException
{
    private const CODE_ITEM_NOT_FOUND = 1201;
    private const CODE_STORAGE_ERROR = 1202;
    private const CODE_INVALID_TTL = 1203;

    public static function itemNotFound(string $key): self
    {
        return self::createException(
            self::CODE_ITEM_NOT_FOUND,
            'CACHE_ITEM_NOT_FOUND',
            "Cache item not found: {$key}"
        );
    }

    public static function storageError(string $details): self
    {
        return self::createException(
            self::CODE_STORAGE_ERROR,
            'CACHE_STORAGE_ERROR',
            "Cache storage error: {$details}"
        );
    }

    public static function invalidTtl(int $ttl): self
    {
        return self::createException(
            self::CODE_INVALID_TTL,
            'INVALID_TTL',
            "Invalid TTL value: {$ttl}"
        );
    }
}
