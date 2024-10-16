<?php

declare(strict_types=1);

namespace KaririCode\Exception\Security;

use KaririCode\Exception\AbstractException;
use KaririCode\Exception\ExceptionMessage;

final class EncryptionException extends AbstractException
{
    public static function encryptionFailed(): self
    {
        return new self(new ExceptionMessage('ENCRYPTION_FAILED', 'Encryption operation failed'));
    }

    public static function decryptionFailed(): self
    {
        return new self(new ExceptionMessage('DECRYPTION_FAILED', 'Decryption operation failed'));
    }
}
