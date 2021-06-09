<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Persistence\SplittableCheckoutRestApiCompanyUnitAddressConnectorPersistenceFactory getFactory()
 */
class SplittableCheckoutRestApiCompanyUnitAddressConnectorRepository extends AbstractRepository implements SplittableCheckoutRestApiCompanyUnitAddressConnectorRepositoryInterface
{
    /**
     * @param string $customerReference
     * @param string $idCompanyUnitAddress
     *
     * @return bool
     */
    public function existsCompanyUnitAddress(string $customerReference, string $idCompanyUnitAddress): bool
    {
        $spyCompanyUnitAddressToCompanyBusinessUnitQuery = $this->getFactory()
            ->getCompanyUnitAddressToCompanyBusinessUnitQuery();

        return $spyCompanyUnitAddressToCompanyBusinessUnitQuery->useCompanyBusinessUnitQuery()
                ->useCompanyUserQuery()
                    ->useCustomerQuery()
                        ->filterByCustomerReference($customerReference)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->useCompanyUnitAddressQuery()
                ->filterByUuid($idCompanyUnitAddress)
            ->endUse()
            ->exists();
    }
}
