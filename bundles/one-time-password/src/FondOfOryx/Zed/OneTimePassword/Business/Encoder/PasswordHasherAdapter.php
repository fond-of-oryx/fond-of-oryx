<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Encoder;

use Symfony\Component\PasswordHasher\PasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class PasswordHasherAdapter implements PasswordHasherInterface
{
    /**
     * @var int
     */
    protected const BCRYPT_FACTOR = 12;

    /**
     * @var \Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface
     */
    protected PasswordEncoderInterface $passwordHasher;

    public function __construct(PasswordEncoderInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function hash(string $plainPassword): string
    {
        return $this->passwordHasher->encodePassword($plainPassword, static::BCRYPT_FACTOR);
    }

    public function verify(string $hashedPassword, string $plainPassword): bool
    {
        return $this->passwordHasher->isPasswordValid($hashedPassword, $plainPassword, static::BCRYPT_FACTOR);
    }

    public function needsRehash(string $hashedPassword): bool
    {
        return $this->passwordHasher->needsRehash($hashedPassword);
    }
}
