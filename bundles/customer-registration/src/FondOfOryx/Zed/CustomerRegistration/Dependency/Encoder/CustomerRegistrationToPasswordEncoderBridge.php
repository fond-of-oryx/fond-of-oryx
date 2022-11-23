<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\Encoder;

use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class CustomerRegistrationToPasswordEncoderBridge implements CustomerRegistrationToPasswordEncoderInterface
{
    /**
     * @var \Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface
     */
    protected $encoder;

    /**
     * @param \Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface $passwordEncoder
     */
    public function __construct(PasswordEncoderInterface $passwordEncoder)
    {
        $this->encoder = $passwordEncoder;
    }

    /**
     * @param string $raw
     * @param string|null $salt
     *
     * @return string
     */
    public function encodePassword(string $raw, ?string $salt = null): string
    {
        return $this->encoder->encodePassword($raw, $salt);
    }
}
