<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\Encoder;

interface CustomerRegistrationToPasswordEncoderInterface
{
    /**
     * @param string $raw
     * @param string|null $salt
     *
     * @return string
     */
    public function encodePassword(string $raw, ?string $salt = null): string;
}
