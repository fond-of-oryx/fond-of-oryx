<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

interface CustomerRegistrationEmailConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function sendWelcomeMail(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer;
}
