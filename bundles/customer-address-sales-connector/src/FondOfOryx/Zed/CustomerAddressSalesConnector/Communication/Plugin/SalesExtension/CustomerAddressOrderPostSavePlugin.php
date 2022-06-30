<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Communication\Plugin\SalesExtension;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\OrderPostSavePluginInterface;

/**
 * @method \FondOfOryx\Zed\CustomerAddressSalesConnector\Business\CustomerAddressSalesConnectorFacadeInterface getFacade()
 */
class CustomerAddressOrderPostSavePlugin extends AbstractPlugin implements OrderPostSavePluginInterface
{
     /**
      * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
      * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
      *
      * @return \Generated\Shared\Transfer\SaveOrderTransfer
      */
    public function execute(SaveOrderTransfer $saveOrderTransfer, QuoteTransfer $quoteTransfer): SaveOrderTransfer
    {
        $this->getFacade()->updateFkResourceCustomerAddressForSalesOrderAddress($quoteTransfer);

        return $saveOrderTransfer;
    }
}
