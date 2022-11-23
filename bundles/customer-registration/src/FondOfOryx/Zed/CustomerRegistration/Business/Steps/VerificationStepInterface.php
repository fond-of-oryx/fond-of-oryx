<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Steps;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

interface VerificationStepInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function verifyEmail(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer;
}
