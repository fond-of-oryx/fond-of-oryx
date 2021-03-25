<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Resetter;

use Generated\Shared\Transfer\CustomerTransfer;

interface OneTimePasswordResetterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return void
     */
    public function resetOneTimePassword(CustomerTransfer $customerTransfer): void;
}
