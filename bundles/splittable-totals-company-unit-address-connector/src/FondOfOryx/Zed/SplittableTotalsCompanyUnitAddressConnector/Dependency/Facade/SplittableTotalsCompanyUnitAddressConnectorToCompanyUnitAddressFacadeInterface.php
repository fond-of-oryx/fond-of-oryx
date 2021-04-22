<?php

namespace FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Dependency\Facade;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface SplittableTotalsCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function getCompanyUnitAddressById(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): CompanyUnitAddressTransfer;
}
