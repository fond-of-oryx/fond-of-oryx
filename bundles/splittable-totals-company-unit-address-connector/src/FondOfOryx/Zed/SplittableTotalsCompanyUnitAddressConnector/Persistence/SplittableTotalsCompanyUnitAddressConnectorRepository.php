<?php

namespace FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Persistence;

use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\SplittableTotalsCompanyUnitAddressConnector\Persistence\SplittableTotalsCompanyUnitAddressConnectorPersistenceFactory getFactory()
 */
class SplittableTotalsCompanyUnitAddressConnectorRepository extends AbstractRepository implements SplittableTotalsCompanyUnitAddressConnectorRepositoryInterface
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
