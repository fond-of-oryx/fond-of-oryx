<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Communication\Plugin\SalesExtension;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\SalesExtension\Dependency\Plugin\OrderPostSavePluginInterface;

/**
 * @method \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\CompanyUnitAddressSalesConnectorFacadeInterface getFacade()
 */
class CompanyUnitAddressOrderPostSavePlugin extends AbstractPlugin implements OrderPostSavePluginInterface
{
     /**
      * @param \Generated\Shared\Transfer\SaveOrderTransfer $saveOrderTransfer
      * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
      *
      * @return \Generated\Shared\Transfer\SaveOrderTransfer
      */
    public function execute(SaveOrderTransfer $saveOrderTransfer, QuoteTransfer $quoteTransfer): SaveOrderTransfer
    {
        $this->getFacade()->updateFkResourceCompanyUnitAddressForSalesOrderAddress($quoteTransfer);

        return $saveOrderTransfer;
    }
}
