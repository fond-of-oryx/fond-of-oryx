<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\CompanyUnitAddressSalesConnectorBusinessFactory getFactory()
 */
class CompanyUnitAddressSalesConnectorFacade extends AbstractFacade implements CompanyUnitAddressSalesConnectorFacadeInterface
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
    public function updateFkResourceCompanyUnitAddressForSalesOrderAddress(
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        return $this->getFactory()
            ->createSalesOrderAddressWriter()
            ->updateFkResourceCompanyUnitAddressByQuote($quoteTransfer);
    }
}
