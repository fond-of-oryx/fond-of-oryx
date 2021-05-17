<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

interface ReturnLabelsRestApiCompanyUnitAddressConnectorRepositoryInterface
{
    /**
     * @param string $uuid
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getCompanyUnitAddressByUuidAndIdCustomer(
        string $uuid,
        int $idCustomer
    ): ?CompanyUnitAddressTransfer;
}
