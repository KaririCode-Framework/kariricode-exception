<?php

declare(strict_types=1);

namespace KaririCode\Exception\File;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class FileException extends AbstractException
{
    private const CODE_NOT_FOUND = 1801;
    private const CODE_PERMISSION_DENIED = 1802;
    private const CODE_UNREADABLE = 1803;
    private const CODE_UPLOAD_FAILED = 1804;

    public static function notFound(string $path): self
    {
        return new self(new ExceptionMessage(
            self::CODE_NOT_FOUND,
            'FILE_NOT_FOUND',
            "File not found: {$path}"
        ));
    }

    public static function permissionDenied(string $path): self
    {
        return new self(new ExceptionMessage(
            self::CODE_PERMISSION_DENIED,
            'PERMISSION_DENIED',
            "Permission denied for file: {$path}"
        ));
    }

    public static function unreadable(string $path): self
    {
        return new self(new ExceptionMessage(
            self::CODE_UNREADABLE,
            'FILE_UNREADABLE',
            "File is not readable: {$path}"
        ));
    }

    public static function uploadFailed(string $filename): self
    {
        return new self(new ExceptionMessage(
            self::CODE_UPLOAD_FAILED,
            'UPLOAD_FAILED',
            "Failed to upload file: {$filename}"
        ));
    }
}
