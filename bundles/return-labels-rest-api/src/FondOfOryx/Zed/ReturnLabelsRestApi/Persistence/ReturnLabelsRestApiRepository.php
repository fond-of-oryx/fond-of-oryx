<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiPersistenceFactory getFactory()
 */
class ReturnLabelsRestApiRepository extends AbstractRepository implements ReturnLabelsRestApiRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getCompanyUnitAddressByCompanyUnitAddressUuid(string $uuid): ?CompanyUnitAddressTransfer
    {
        /** @var \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery $spyCompanyUnitAddressQuery */
        $spyCompanyUnitAddressQuery = $this->getFactory()
            ->getCompanyUnitAddressQuery()
            ->clear()
            ->filterByUuid($uuid);

        $spyCompanyUnitAddressQuery->leftJoinCountry();
        $spyCompanyUnitAddressEntity = $spyCompanyUnitAddressQuery->findOne();

        if ($spyCompanyUnitAddressEntity === null) {
            return null;
        }

        return $this->getFactory()
            ->createCompanyUnitAddressMapper()
            ->mapEntityToTransfer($spyCompanyUnitAddressEntity, new CompanyUnitAddressTransfer());
    }
}
