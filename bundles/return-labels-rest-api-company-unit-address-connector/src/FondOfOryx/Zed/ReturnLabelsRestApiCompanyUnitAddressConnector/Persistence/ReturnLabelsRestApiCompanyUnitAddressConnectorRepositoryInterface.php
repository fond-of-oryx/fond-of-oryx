<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface ReturnLabelsRestApiCompanyUnitAddressConnectorRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getCompanyUnitAddressByUuid(string $uuid): ?CompanyUnitAddressTransfer;
}
