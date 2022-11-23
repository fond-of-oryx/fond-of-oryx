<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\PostStep;

use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface getFacade()
 */
class VerificationLinkGeneratorPostStepPlugin extends AbstractPlugin implements CustomerRegistrationPostStepPluginInterface
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
            $bag->setEmailVerificationLink($this->getFacade()->generateEmailVerificationLink($customerTransfer));
        }

        return $customerRegistrationRequestTransfer->setBag($bag);
    }
}
