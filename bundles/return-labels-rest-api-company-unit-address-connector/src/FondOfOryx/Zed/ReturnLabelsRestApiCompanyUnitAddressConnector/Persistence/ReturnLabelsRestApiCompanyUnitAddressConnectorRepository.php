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
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getCompanyUnitAddressByUuid(string $uuid): ?CompanyUnitAddressTransfer
    {
        $spyCompanyUnitAddressQuery = $this->getFactory()
            ->getCompanyUnitAddressQuery()
            ->clear();

        $spyCompanyUnitAddressEntity = $spyCompanyUnitAddressQuery
            ->filterByUuid($uuid)
            ->innerJoinCountry()
            ->findOne();

        if ($spyCompanyUnitAddressEntity === null) {
            return null;
        }

        return $this->getFactory()->createCompanyUnitAddressMapper()
            ->mapEntityToTransfer($spyCompanyUnitAddressEntity, new CompanyUnitAddressTransfer());
    }
}
