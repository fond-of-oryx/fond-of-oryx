<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence;

interface SplittableCheckoutRestApiCompanyUnitAddressConnectorRepositoryInterface
{
    /**
     * @param string $customerReference
     * @param string $companyUserReference
     * @param string $idCompanyUnitAddress
     *
     * @return bool
     */
    public function existsAddress(
        string $customerReference,
        string $companyUserReference,
        string $idCompanyUnitAddress
    ): bool;

    /**
     * @param string $customerReference
     * @param string $companyUserReference
     * @param string $idCompanyUnitAddress
     *
     * @return bool
     */
    public function existsDefaultBillingAddress(
        string $customerReference,
        string $companyUserReference,
        string $idCompanyUnitAddress
    ): bool;
}
