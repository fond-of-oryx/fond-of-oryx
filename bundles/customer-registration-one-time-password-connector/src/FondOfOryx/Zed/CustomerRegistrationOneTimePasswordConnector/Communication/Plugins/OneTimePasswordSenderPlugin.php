<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Communication\Plugins;

use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPluginInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\CustomerRegistrationOneTimePasswordConnectorFacadeInterface getFacade()
 */
class OneTimePasswordSenderPlugin extends AbstractPlugin implements CustomerRegistrationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function execute(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        return $this->getFacade()->sendOneTimePassword($customerRegistrationRequestTransfer);
    }
}
