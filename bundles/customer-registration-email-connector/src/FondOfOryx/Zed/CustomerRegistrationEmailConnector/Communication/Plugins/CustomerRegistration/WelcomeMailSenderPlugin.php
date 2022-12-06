<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Communication\Plugins\CustomerRegistration;

use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPluginInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\CustomerRegistrationEmailConnectorFacadeInterface getFacade()
 */
class WelcomeMailSenderPlugin extends AbstractPlugin implements CustomerRegistrationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function execute(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        return $this->getFacade()->sendWelcomeMail($customerRegistrationRequestTransfer);
    }
}
