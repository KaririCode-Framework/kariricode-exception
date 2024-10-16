<?php

declare(strict_types=1);

namespace KaririCode\Exception\File;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class FileException extends AbstractException
{
    public static function notFound(string $path): self
    {
        return new self(new ExceptionMessage('FILE_NOT_FOUND', "File not found: {$path}"));
    }

    public static function permissionDenied(string $path): self
    {
        return new self(new ExceptionMessage('PERMISSION_DENIED', "Permission denied for file: {$path}"));
    }

    public static function unreadable(string $path): self
    {
        return new self(new ExceptionMessage('FILE_UNREADABLE', "File is not readable: {$path}"));
    }

    public static function uploadFailed(string $filename): self
    {
        return new self(new ExceptionMessage('UPLOAD_FAILED', "Failed to upload file: {$filename}"));
    }
}
