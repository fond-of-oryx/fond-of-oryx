<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Sender;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;

interface OneTimePasswordLoginLinkSenderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer|null $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function requestLoginLink(
        CustomerTransfer $customerTransfer,
        ?OneTimePasswordAttributesTransfer $attributesTransfer = null
    ): OneTimePasswordResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer|null $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function requestLoginLinkWithOrderReference(
        OrderTransfer $orderTransfer,
        ?OneTimePasswordAttributesTransfer $attributesTransfer = null
    ): OneTimePasswordResponseTransfer;
}
