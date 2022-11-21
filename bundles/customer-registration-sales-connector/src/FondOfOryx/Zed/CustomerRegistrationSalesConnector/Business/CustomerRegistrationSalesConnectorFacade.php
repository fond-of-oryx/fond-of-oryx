<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\CustomerRegistrationSalesConnectorBusinessFactory getFactory()
 */
class CustomerRegistrationSalesConnectorFacade extends AbstractFacade implements CustomerRegistrationSalesConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SaveOrderTransfer
     */
    public function createCustomerAccount(SaveOrderTransfer $saveOrderTransfer, QuoteTransfer $quoteTransfer): SaveOrderTransfer
    {
        return $this->getFactory()->createRegistrationProcessor()->processRegistration($saveOrderTransfer, $quoteTransfer);
    }
}
