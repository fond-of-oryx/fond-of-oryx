<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;

interface CompanyUnitAddressSalesConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Adds relations between sales order address and company unit address
     * - The addresses (billing and shipping) are used for building relations
     * - ...
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function updateFkResourceCompanyUnitAddressForSalesOrderAddress(
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer;
}
