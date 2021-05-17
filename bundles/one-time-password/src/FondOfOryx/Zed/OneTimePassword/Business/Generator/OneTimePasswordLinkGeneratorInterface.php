<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OrderTransfer;

interface OneTimePasswordLinkGeneratorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string|null
     */
    public function generateLoginLink(
        CustomerTransfer $customerTransfer
    ): ?string;

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return string|null
     */
    public function generateLoginLinkWithOrderReference(
        OrderTransfer $orderTransfer
    ): ?string;
}
