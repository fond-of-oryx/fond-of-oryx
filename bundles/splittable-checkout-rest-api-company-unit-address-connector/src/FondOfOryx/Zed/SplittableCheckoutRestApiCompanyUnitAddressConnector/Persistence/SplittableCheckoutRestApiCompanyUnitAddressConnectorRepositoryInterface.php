<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence;

interface SplittableCheckoutRestApiCompanyUnitAddressConnectorRepositoryInterface
{
    /**
     * @param string $customerReference
     * @param string $idCompanyUnitAddress
     *
     * @return bool
     */
    public function existsCompanyUnitAddress(string $customerReference, string $idCompanyUnitAddress): bool;
}
