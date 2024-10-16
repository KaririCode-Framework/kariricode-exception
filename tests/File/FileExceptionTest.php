<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\File;

use KaririCode\Exception\File\FileException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class FileExceptionTest extends AbstractExceptionTest
{
    public function testNotFound(): void
    {
        $path = '/path/to/file.txt';
        $exception = FileException::notFound($path);
        $this->assertExceptionStructure($exception, 'FILE_NOT_FOUND', "File not found: {$path}", 1801);
    }

    public function testPermissionDenied(): void
    {
        $path = '/path/to/file.txt';
        $exception = FileException::permissionDenied($path);
        $this->assertExceptionStructure($exception, 'PERMISSION_DENIED', "Permission denied for file: {$path}", 1802);
    }

    public function testUnreadable(): void
    {
        $path = '/path/to/file.txt';
        $exception = FileException::unreadable($path);
        $this->assertExceptionStructure($exception, 'FILE_UNREADABLE', "File is not readable: {$path}", 1803);
    }

    public function testUploadFailed(): void
    {
        $filename = 'upload.txt';
        $exception = FileException::uploadFailed($filename);
        $this->assertExceptionStructure($exception, 'UPLOAD_FAILED', "Failed to upload file: {$filename}", 1804);
    }
}
