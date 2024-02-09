<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence;

use Orm\Zed\CompanyBusinessUnit\Persistence\Map\SpyCompanyBusinessUnitTableMap;
use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence\SplittableCheckoutRestApiCompanyUnitAddressConnectorPersistenceFactory getFactory()
 */
class SplittableCheckoutRestApiCompanyUnitAddressConnectorRepository extends AbstractRepository implements SplittableCheckoutRestApiCompanyUnitAddressConnectorRepositoryInterface
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
    ): bool {
        $query = $this->getFactory()
            ->getCompanyUnitAddressQuery()
            ->clear();

        $query = $query->useCompanyQuery()
                ->filterByIsActive(true)
                ->useCompanyUserQuery()
                    ->filterByIsActive(true)
                    ->filterByCompanyUserReference($companyUserReference)
                    ->useCustomerQuery()
                        ->filterByCustomerReference($customerReference)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->filterByUuid($idCompanyUnitAddress);

        return $query->exists();
    }

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
    ): bool {
        $query = $this->getFactory()
            ->getCompanyUnitAddressToCompanyBusinessUnitQuery()
            ->clear();

        $query = $query->useCompanyBusinessUnitQuery()
                ->useCompanyUserQuery()
                    ->filterByIsActive(true)
                    ->filterByCompanyUserReference($companyUserReference)
                    ->useCustomerQuery()
                        ->filterByCustomerReference($customerReference)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->useCompanyUnitAddressQuery()
                ->filterByUuid($idCompanyUnitAddress)
            ->endUse()
            ->where(
                sprintf(
                    '%s = %s',
                    SpyCompanyBusinessUnitTableMap::COL_DEFAULT_BILLING_ADDRESS,
                    SpyCompanyUnitAddressTableMap::COL_ID_COMPANY_UNIT_ADDRESS,
                ),
            );

        return $query->exists();
    }
}
