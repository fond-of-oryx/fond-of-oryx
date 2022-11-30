<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Communication\Plugins\CustomerRegistration;

use Exception;
use FondOfOryx\Shared\CustomerRegistration\CustomerRegistrationConstants;
use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\CustomerRegistrationEmailConnectorFacadeInterface getFacade()
 */
class WelcomeMailSenderPostPlugin extends AbstractPlugin implements CustomerRegistrationPostStepPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function execute(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        if ($customerRegistrationRequestTransfer->getType() !== CustomerRegistrationConstants::TYPE_REGISTRATION) {
            return $customerRegistrationRequestTransfer;
        }

        $bag = $customerRegistrationRequestTransfer->getBagOrFail();
        $customerTransfer = $bag->getCustomer();

        if ($customerTransfer === null || $bag->getEmailVerificationLink() === null) {
            return $customerRegistrationRequestTransfer;
        }

        try {
            $this->getFacade()->sendWelcomeMail($customerTransfer, $bag->getEmailVerificationLink());
            $bag->setMessage('Verification Link successfully sent!')
                ->setIsWelcomeMailSent(true);
        } catch (Exception $exception) {
            $bag->setMessage('Could not send verification Link!')
                ->setIsWelcomeMailSent(false);
        }

        return $customerRegistrationRequestTransfer->setBag($bag);
    }
}
