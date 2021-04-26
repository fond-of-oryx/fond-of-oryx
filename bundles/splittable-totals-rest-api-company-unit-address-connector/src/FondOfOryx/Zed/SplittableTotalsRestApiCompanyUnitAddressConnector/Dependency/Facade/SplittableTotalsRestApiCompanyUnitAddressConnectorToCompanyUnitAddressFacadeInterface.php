<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Dependency\Facade;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface SplittableTotalsRestApiCompanyUnitAddressConnectorToCompanyUnitAddressFacadeInterface
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
