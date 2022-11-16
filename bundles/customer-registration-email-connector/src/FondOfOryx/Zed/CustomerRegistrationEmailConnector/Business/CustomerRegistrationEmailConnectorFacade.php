<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business\CustomerRegistrationEmailConnectorBusinessFactory getFactory()
 */
class CustomerRegistrationEmailConnectorFacade extends AbstractFacade implements CustomerRegistrationEmailConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param string $link
     *
     * @return void
     */
    public function sendWelcomeMail(CustomerTransfer $customerTransfer, string $link): void
    {
        $this->getFactory()
            ->createWelcomeMailSender()
            ->sendWelcomeMail($customerTransfer, $link);
    }
}
