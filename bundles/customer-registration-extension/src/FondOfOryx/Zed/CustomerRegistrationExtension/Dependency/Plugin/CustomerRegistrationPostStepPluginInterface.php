<?php

namespace FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

interface CustomerRegistrationPostStepPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function execute(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer;
}
