<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Business\Writer;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface SalesOrderAddressWriterInterface
{
    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public function updateFkResourceCustomerAddressByAddress(AddressTransfer $addressTransfer): AddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function updateFkResourceCustomerAddressByQuote(QuoteTransfer $quoteTransfer): QuoteTransfer;
}
