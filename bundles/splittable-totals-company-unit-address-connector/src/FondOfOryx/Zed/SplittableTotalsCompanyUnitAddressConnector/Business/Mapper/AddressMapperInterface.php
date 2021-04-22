<?php

namespace FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Business\Mapper;

use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface AddressMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\AddressTransfer
     */
    public function fromCompanyUnitAddressTransfer(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): AddressTransfer;
}
