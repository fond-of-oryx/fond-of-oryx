<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Persistence\SplittableTotalsRestApiCompanyUnitAddressConnectorPersistenceFactory getFactory()
 */
class SplittableTotalsRestApiCompanyUnitAddressConnectorRepository extends AbstractRepository implements SplittableTotalsRestApiCompanyUnitAddressConnectorRepositoryInterface
{
    /**
     * @param int $idCustomer
     * @param int $idCompanyUnitAddress
     *
     * @return bool
     */
    public function existsCompanyUnitAddress(int $idCustomer, int $idCompanyUnitAddress): bool
    {
        $spyCompanyUnitAddressToCompanyBusinessUnitQuery = $this->getFactory()
            ->getCompanyUnitAddressToCompanyBusinessUnitQuery();

        return $spyCompanyUnitAddressToCompanyBusinessUnitQuery->useCompanyBusinessUnitQuery()
                ->useCompanyUserQuery()
                    ->filterByFkCustomer($idCustomer)
                ->endUse()
            ->endUse()
            ->filterByFkCompanyUnitAddress($idCompanyUnitAddress)
            ->exists();
    }
}
