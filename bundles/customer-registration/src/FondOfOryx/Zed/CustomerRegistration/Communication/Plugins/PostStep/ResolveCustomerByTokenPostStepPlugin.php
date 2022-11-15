<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\PostStep;

use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface getRepository()
 */
class ResolveCustomerByTokenPostStepPlugin extends AbstractPlugin implements CustomerRegistrationPostStepPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function execute(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        $bag = $customerRegistrationRequestTransfer->getBagOrFail();
        $customerTransfer = $bag->getCustomer();

        if ($customerTransfer !== null) {
            return $customerRegistrationRequestTransfer;
        }

        $customerTransfer = $this->getRepository()->findCustomerByToken($customerRegistrationRequestTransfer->getAttributesOrFail()->getTokenOrFail());

        return $customerRegistrationRequestTransfer->setBag($bag->setCustomer($customerTransfer));
    }
}
