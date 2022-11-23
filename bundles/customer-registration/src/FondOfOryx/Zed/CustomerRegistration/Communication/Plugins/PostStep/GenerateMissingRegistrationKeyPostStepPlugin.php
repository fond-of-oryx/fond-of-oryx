<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\PostStep;

use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\Business\CustomerRegistrationFacadeInterface getFacade()
 */
class GenerateMissingRegistrationKeyPostStepPlugin extends AbstractPlugin implements CustomerRegistrationPostStepPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function execute(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        $bag = $customerRegistrationRequestTransfer->getBagOrFail();
        $attributes = $customerRegistrationRequestTransfer->getAttributes();
        $customerTransfer = $bag->getCustomer();

        if ($customerTransfer !== null && $customerTransfer->getRegistrationKey() === null) {
            $customerTransfer->setRegistrationKey($this->getFacade()->generateToken());
            $customerTransfer = $this->getFacade()->saveRegistrationKeyToCustomer($customerTransfer);
            if ($attributes !== null && $attributes->getAcceptGdpr()) {
                $attributes->setToken($customerTransfer->getRegistrationKey());
            }
        }

        return $customerRegistrationRequestTransfer
            ->setBag($bag)
            ->setAttributes($attributes);
    }
}
