<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

interface CustomerRegistrationOneTimePasswordConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function sendOneTimePassword(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer;
}
