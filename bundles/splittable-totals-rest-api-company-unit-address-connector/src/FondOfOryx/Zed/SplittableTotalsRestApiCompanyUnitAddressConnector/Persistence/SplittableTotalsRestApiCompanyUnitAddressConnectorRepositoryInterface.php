<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence;

interface SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface
{
    /**
     * @param string $customerReference
     * @param string $idCompanyUnitAddress
     *
     * @return bool
     */
    public function existsCompanyUnitAddress(string $customerReference, string $idCompanyUnitAddress): bool;
}
