<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\Steps;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

interface OneTimePasswordStepInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function sendLoginLink(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer;
}
