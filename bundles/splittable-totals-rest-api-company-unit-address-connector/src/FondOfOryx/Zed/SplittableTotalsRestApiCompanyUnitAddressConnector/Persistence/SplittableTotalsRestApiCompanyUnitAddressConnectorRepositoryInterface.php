<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence;

interface SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface
{
    /**
     * @param int $idCustomer
     * @param string $idCompanyUnitAddress
     *
     * @return bool
     */
    public function existsCompanyUnitAddress(int $idCustomer, string $idCompanyUnitAddress): bool;
}
