<?php

declare(strict_types=1);

namespace Afonso\Cryphpt;

use InvalidArgumentException;

/**
 * An implementation of Caesar's chiper.
 */
class CaesarCipher implements Cipher
{
    /**
     * @inheritDoc
     * @throws \InvalidArgumentException if the key is not an integer or if the
     * plaintext contains anything that is not an ASCII letter byte.
     */
    public function encrypt(mixed $key, array $bytes): array
    {
        if (!is_int($key)) {
            throw new InvalidArgumentException("Key '{$key}' must be an integer");
        }

        $fn = function ($b) use ($key) {
            $min = null;
            if (0x41 <= $b && $b <= 0x5a) {
                $min = 0x41;
            } elseif (0x61 <= $b && $b <= 0x7a) {
                $min = 0x61;
            } else {
                throw new InvalidArgumentException("Byte {$b} is not an ASCII letter character");
            }

            $c = $min + (($b - $min + $key) % 26);
            if ($c < $min) {
                $c += 26;
            }

            return $c;
        };
        return array_map($fn, $bytes);
    }

    /**
     * @inheritDoc
     * @throws \InvalidArgumentException if the key is not an integer or if the
     * ciphertext contains anything that is not an ASCII letter byte.
     */
    public function decrypt(mixed $key, array $bytes): array
    {
        if (!is_int($key)) {
            throw new InvalidArgumentException("Key '{$key}' must be an integer");
        }
        return $this->encrypt(-$key, $bytes);
    }
}
