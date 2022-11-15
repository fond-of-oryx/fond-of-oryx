<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\PreCondition;

use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

class GdprAreNotAcceptedPreConditionPlugin implements CustomerRegistrationPreStepConditionPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return bool
     */
    public function checkPreCondition(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): bool
    {
        return $customerRegistrationRequestTransfer->getBagOrFail()->getCustomer()->getGdprAccepted() !== true;
    }
}
