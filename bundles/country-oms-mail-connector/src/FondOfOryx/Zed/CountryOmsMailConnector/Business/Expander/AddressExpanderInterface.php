<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander;

use Generated\Shared\Transfer\AddressTransfer;

interface AddressExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\AddressTransfer $addressTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public function expand(AddressTransfer $addressTransfer): AddressTransfer;
}
