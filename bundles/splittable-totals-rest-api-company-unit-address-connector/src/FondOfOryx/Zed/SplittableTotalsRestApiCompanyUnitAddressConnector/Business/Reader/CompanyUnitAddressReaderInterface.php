<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Reader;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;

interface CompanyUnitAddressReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    public function getBillingAddressBySplittableTotalsRequestTransfer(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
    ): ?AddressTransfer;

    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer|null
     */
    public function getShippingAddressBySplittableTotalsRequestTransfer(
        SplittableTotalsRequestTransfer $splittableTotalsRequestTransfer
    ): ?AddressTransfer;
}
