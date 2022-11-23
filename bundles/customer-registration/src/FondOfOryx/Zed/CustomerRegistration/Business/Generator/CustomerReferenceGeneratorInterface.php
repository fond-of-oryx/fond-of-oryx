<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Generator;

interface CustomerReferenceGeneratorInterface
{
    /**
     * @return string
     */
    public function generateCustomerReference(): string;
}
