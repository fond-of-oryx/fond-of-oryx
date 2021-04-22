<?php

namespace FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Persistence;

interface SplittableTotalsCompanyUnitAddressConnectorRepositoryInterface
{
    /**
     * @param int $idCustomer
     * @param int $idCompanyUnitAddress
     *
     * @return bool
     */
    public function existsCompanyUnitAddress(int $idCustomer, int $idCompanyUnitAddress): bool;
}
