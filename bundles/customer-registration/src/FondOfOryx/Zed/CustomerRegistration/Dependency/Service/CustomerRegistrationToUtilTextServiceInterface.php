<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\Service;

interface CustomerRegistrationToUtilTextServiceInterface
{
    /**
     * @param int $length
     *
     * @return string
     */
    public function generateRandomString(int $length): string;
}
