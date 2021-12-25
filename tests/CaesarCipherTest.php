<?php

declare(strict_types=1);

namespace Afonso\Cryphpt\Tests;

use Afonso\Cryphpt\CaesarCipher;
use InvalidArgumentException;

class CaesarCipherTest extends \PHPUnit\Framework\TestCase
{
    public function testEncrypt()
    {
        $algo = new CaesarCipher();

        // "defbGHIC"
        $expected = [0x64, 0x65, 0x66, 0x62, 0x47, 0x48, 0x49, 0x43];

        $this->assertEquals(
            $expected,
            // "abcyDEFZ"
            $algo->encrypt(3, [0x61, 0x62, 0x63, 0x79, 0x44, 0x45, 0x46, 0x5a])
        );
    }

    public function testEncryptWithNonAsciiBytes()
    {
        $this->expectException(InvalidArgumentException::class);

        $algo = new CaesarCipher();

        $algo->encrypt(3, [0x60, 0x61]);
    }

    public function testEncryptWithNonIntegerKey()
    {
        $this->expectException(InvalidArgumentException::class);

        $algo = new CaesarCipher();

        $algo->encrypt('a', [0x61]);
    }

    public function testDecrypt()
    {
        $algo = new CaesarCipher();

        // "abcyDEFZ"
        $expected = [0x61, 0x62, 0x63, 0x79, 0x44, 0x45, 0x46, 0x5a];

        $this->assertEquals(
            $expected,
            // "defbGHIC"
            $algo->decrypt(3, [0x64, 0x65, 0x66, 0x62, 0x47, 0x48, 0x49, 0x43])
        );
    }

    public function testDecryptWithNonAsciiBytes()
    {
        $this->expectException(InvalidArgumentException::class);

        $algo = new CaesarCipher();

        $algo->decrypt(3, [0x60, 0x61]);
    }

    public function testDecryptWithNonIntegerKey()
    {
        $this->expectException(InvalidArgumentException::class);

        $algo = new CaesarCipher();

        $algo->decrypt('a', [0x61]);
    }
}
