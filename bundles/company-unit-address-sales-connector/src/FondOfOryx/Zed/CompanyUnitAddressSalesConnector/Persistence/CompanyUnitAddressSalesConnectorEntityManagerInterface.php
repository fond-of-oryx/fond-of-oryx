<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Persistence;

interface CompanyUnitAddressSalesConnectorEntityManagerInterface
{
    /**
     * @param int $idSalesOrder
     * @param int $idCompanyUnitAddress
     *
     * @return void
     */
    public function updateFkResourceCompanyUnitAddressForSalesOrderAddress(
        int $idSalesOrder,
        int $idCompanyUnitAddress
    ): void;
}
