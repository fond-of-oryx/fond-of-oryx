<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence\SplittableTotalsRestApiCompanyUnitAddressConnectorPersistenceFactory getFactory()
 */
class SplittableTotalsRestApiCompanyUnitAddressConnectorRepository extends AbstractRepository implements SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface
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
