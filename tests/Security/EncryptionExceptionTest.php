<?php

declare(strict_types=1);

namespace KaririCode\Exception\Tests\Security;

use KaririCode\Exception\Security\EncryptionException;
use KaririCode\Exception\Tests\AbstractExceptionTest;

final class EncryptionExceptionTest extends AbstractExceptionTest
{
    public function testEncryptionFailed(): void
    {
        $exception = EncryptionException::encryptionFailed();
        $this->assertExceptionStructure(
            $exception,
            'ENCRYPTION_FAILED',
            'Encryption operation failed',
            2601
        );
    }

    public function testDecryptionFailed(): void
    {
        $exception = EncryptionException::decryptionFailed();
        $this->assertExceptionStructure(
            $exception,
            'DECRYPTION_FAILED',
            'Decryption operation failed',
            2602
        );
    }
}
