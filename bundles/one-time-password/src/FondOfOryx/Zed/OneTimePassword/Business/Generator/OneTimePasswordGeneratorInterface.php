<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface OneTimePasswordGeneratorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function generateOneTimePassword(CustomerTransfer $customerTransfer): CustomerResponseTransfer;
}
