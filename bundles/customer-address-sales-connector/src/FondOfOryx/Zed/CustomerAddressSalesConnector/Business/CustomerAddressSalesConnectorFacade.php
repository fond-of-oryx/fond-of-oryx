<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CustomerAddressSalesConnector\Business\CustomerAddressSalesConnectorBusinessFactory getFactory()
 */
class CustomerAddressSalesConnectorFacade extends AbstractFacade implements CustomerAddressSalesConnectorFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function updateFkResourceCustomerAddressForSalesOrderAddress(
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        return $this->getFactory()
            ->createSalesOrderAddressWriter()
            ->updateFkResourceCustomerAddressByQuote($quoteTransfer);
    }
}
