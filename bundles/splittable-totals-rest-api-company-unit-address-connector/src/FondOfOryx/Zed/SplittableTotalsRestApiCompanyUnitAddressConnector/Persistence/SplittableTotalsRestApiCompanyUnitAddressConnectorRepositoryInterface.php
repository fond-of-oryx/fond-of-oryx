<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence;

interface SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface
{
    /**
     * @param int $idCustomer
     * @param int $idCompanyUnitAddress
     *
     * @return bool
     */
    public function existsCompanyUnitAddress(int $idCustomer, int $idCompanyUnitAddress): bool;
}
