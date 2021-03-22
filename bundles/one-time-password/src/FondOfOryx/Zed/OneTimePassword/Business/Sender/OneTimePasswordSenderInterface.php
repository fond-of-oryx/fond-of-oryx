<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Sender;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface OneTimePasswordSenderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function requestOneTimePassword(
        CustomerTransfer $customerTransfer
    ): CustomerResponseTransfer;
}
