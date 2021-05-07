<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

interface OneTimePasswordGeneratorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function generateOneTimePassword(CustomerTransfer $customerTransfer): OneTimePasswordResponseTransfer;
}
