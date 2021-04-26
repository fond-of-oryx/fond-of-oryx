<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Mapper;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class AddressMapper implements AddressMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public function fromCompanyUnitAddressTransfer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): AddressTransfer {
        return (new AddressTransfer())
            ->fromArray($companyUnitAddressTransfer->toArray(), false);
    }
}
