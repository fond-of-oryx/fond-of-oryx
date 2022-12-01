<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\Steps;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

interface WelcomeMailSenderStepInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function sendWelcomeMail(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer;
}
