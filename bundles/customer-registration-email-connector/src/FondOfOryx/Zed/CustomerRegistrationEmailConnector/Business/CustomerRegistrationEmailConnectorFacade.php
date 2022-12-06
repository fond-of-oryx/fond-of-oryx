<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\CustomerRegistrationEmailConnectorBusinessFactory getFactory()
 */
class CustomerRegistrationEmailConnectorFacade extends AbstractFacade implements CustomerRegistrationEmailConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function sendWelcomeMail(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        return $this->getFactory()
            ->createWelcomeMailSenderStep()
            ->sendWelcomeMail($customerRegistrationRequestTransfer);
    }
}
