<?php

declare(strict_types=1);

namespace Afonso\Cryphpt;

/**
 * An interface for cryptographic ciphers, i.e., algorithms for performing
 * encryption or decryption.
 */
interface Cipher
{
    /**
     * Encrypt the given plaintext bytes using the specified key.
     */
    public function encrypt(mixed $key, array $bytes): array;

    /**
     * Decrypt the given ciphertext bytes using the specified key.
     */
    public function decrypt(mixed $key, array $bytes): array;
}
