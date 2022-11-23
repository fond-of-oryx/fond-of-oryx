<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Generator;

use Generated\Shared\Transfer\CustomerTransfer;

interface EmailVerificationLinkGeneratorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string
     */
    public function generateLink(CustomerTransfer $customerTransfer): string;
}
