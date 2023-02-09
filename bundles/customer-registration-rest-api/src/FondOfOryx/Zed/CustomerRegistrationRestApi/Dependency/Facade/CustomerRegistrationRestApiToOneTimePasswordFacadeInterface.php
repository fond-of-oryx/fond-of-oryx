<?php

namespace FondOfOryx\Zed\CustomerRegistrationRestApi\Dependency\Facade;

use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

interface CustomerRegistrationRestApiToOneTimePasswordFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function requestLoginLink(CustomerTransfer $customerTransfer): OneTimePasswordResponseTransfer;
}
