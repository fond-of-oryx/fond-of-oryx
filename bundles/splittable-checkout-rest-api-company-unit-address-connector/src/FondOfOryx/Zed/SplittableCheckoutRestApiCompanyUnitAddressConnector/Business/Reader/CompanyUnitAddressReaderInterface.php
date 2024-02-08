<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Reader;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

interface CompanyUnitAddressReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    public function getBillingAddressByRestSplittableCheckoutRequestAndQuote(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): ?AddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    public function getShippingAddressByRestSplittableCheckoutRequestAndQuote(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): ?AddressTransfer;
}
