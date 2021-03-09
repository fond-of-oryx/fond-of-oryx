<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\SplittableCheckout\Address;

use Generated\Shared\Transfer\AddressesTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface AddressReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\AddressesTransfer
     */
    public function getAddressesTransfer(QuoteTransfer $quoteTransfer): AddressesTransfer;
}
