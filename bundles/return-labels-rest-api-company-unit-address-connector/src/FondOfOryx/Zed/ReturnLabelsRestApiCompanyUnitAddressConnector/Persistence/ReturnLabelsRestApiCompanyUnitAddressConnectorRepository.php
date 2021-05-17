<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\ReturnLabelsRestApiCompanyUnitAddressConnectorPersistenceFactory getFactory()
 */
class ReturnLabelsRestApiCompanyUnitAddressConnectorRepository extends AbstractRepository implements
    ReturnLabelsRestApiCompanyUnitAddressConnectorRepositoryInterface
{
    /**
     * @param string $uuid
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getCompanyUnitAddressByUuidAndIdCustomer(
        string $uuid,
        int $idCustomer
    ): ?CompanyUnitAddressTransfer {
        $spyCompanyUnitAddressQuery = $this->getFactory()
            ->getCompanyUnitAddressQuery()
            ->clear();

        $spyCompanyUnitAddressEntity = $spyCompanyUnitAddressQuery->filterByUuid($uuid)
            ->useCompanyQuery()
                ->useCompanyUserQuery()
                    ->useCustomerQuery()
                        ->filterByIdCustomer($idCustomer)
                    ->endUse()
                ->endUse()
            ->endUse()
            ->innerJoinCountry()
            ->findOne();

        if ($spyCompanyUnitAddressEntity === null) {
            return null;
        }

        return $this->getFactory()->createCompanyUnitAddressMapper()
            ->mapEntityToTransfer($spyCompanyUnitAddressEntity, new CompanyUnitAddressTransfer());
    }
}
