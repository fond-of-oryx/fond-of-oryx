<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\Facade;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

interface CustomerRegistrationToOneTimePasswordFacadeInterface
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
}
