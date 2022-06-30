<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\Writer;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface SalesOrderAddressWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public function updateFkResourceCompanyUnitAddressByAddress(AddressTransfer $addressTransfer): AddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function updateFkResourceCompanyUnitAddressByQuote(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
