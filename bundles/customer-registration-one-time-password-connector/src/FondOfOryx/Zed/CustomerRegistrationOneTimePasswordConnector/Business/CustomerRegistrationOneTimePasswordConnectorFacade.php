<?php

namespace FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business;

use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationOneTimePasswordConnector\Business\CustomerRegistrationOneTimePasswordConnectorBusinessFactory getFactory()
 */
class CustomerRegistrationOneTimePasswordConnectorFacade extends AbstractFacade implements CustomerRegistrationOneTimePasswordConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function sendOneTimePassword(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        return $this->getFactory()->createOneTimePasswordStep()->sendLoginLink($customerRegistrationRequestTransfer);
    }
}
