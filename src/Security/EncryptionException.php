<?php

declare(strict_types=1);

namespace KaririCode\Exception\Security;

use KaririCode\Exception\AbstractException;

final class EncryptionException extends AbstractException
{
    private const CODE_ENCRYPTION_FAILED = 2601;
    private const CODE_DECRYPTION_FAILED = 2602;

    public static function encryptionFailed(): self
    {
        return self::createException(
            self::CODE_ENCRYPTION_FAILED,
            'ENCRYPTION_FAILED',
            'Encryption operation failed'
        );
    }

    public static function decryptionFailed(): self
    {
        return self::createException(
            self::CODE_DECRYPTION_FAILED,
            'DECRYPTION_FAILED',
            'Decryption operation failed'
        );
    }
}
