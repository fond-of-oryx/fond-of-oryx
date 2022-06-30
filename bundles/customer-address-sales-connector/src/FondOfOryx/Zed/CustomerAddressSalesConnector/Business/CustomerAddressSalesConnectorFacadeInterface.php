<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Business;

use Generated\Shared\Transfer\QuoteTransfer;

interface CustomerAddressSalesConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Adds relations between sales order address and customer address
     * - The addresses (billing and shipping) are used for building relations
     * - ...
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function updateFkResourceCustomerAddressForSalesOrderAddress(
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer;
}
