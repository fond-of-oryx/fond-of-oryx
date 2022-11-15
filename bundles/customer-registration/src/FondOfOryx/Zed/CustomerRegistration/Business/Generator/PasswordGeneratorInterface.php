<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Generator;

interface PasswordGeneratorInterface
{
    /**
     * @param int $length
     * @param string|null $keySpace
     *
     * @return string
     */
    public function generate(int $length = 20, ?string $keySpace = null): string;

    /**
     * @param int $length
     *
     * @return string
     */
    public function generateRandomString(int $length = 32): string;
}
