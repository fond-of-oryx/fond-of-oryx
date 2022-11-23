<?php

namespace FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

interface CustomerRegistrationPreStepConditionPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return bool
     */
    public function checkPreCondition(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): bool;
}
