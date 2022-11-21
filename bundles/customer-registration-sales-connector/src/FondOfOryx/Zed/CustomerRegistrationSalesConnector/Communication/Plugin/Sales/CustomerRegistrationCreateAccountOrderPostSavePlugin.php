<?php

namespace FondOfOryx\Zed\CustomerRegistrationSalesConnector\Communication\Plugin\Sales;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\OrderPostSavePluginInterface;

/**
 * @method \FondOfOryx\Zed\CustomerRegistrationSalesConnector\Business\CustomerRegistrationSalesConnectorFacadeInterface getFacade()
 */
class CustomerRegistrationCreateAccountOrderPostSavePlugin extends AbstractPlugin implements OrderPostSavePluginInterface
{
     /**
      * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
      * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
      *
      * @return \Generated\Shared\Transfer\SaveOrderTransfer
      */
    public function execute(SaveOrderTransfer $saveOrderTransfer, QuoteTransfer $quoteTransfer): SaveOrderTransfer
    {
        return $this->getFacade()->createCustomerAccount($saveOrderTransfer, $quoteTransfer);
    }
}
