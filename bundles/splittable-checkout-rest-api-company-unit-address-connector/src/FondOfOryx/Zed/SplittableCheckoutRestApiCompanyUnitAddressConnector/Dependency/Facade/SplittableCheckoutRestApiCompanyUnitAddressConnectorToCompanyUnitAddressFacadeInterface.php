<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Dependency\Facade;

use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface SplittableCheckoutRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer
     */
    public function findCompanyBusinessUnitAddressByUuid(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressResponseTransfer;
}
