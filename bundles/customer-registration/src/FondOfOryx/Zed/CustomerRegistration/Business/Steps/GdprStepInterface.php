<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Steps;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

interface GdprStepInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function checkGdprState(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer;
}
