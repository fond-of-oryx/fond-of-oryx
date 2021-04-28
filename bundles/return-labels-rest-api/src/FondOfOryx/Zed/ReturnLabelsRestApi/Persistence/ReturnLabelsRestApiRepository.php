<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Orm\Zed\CompanyUnitAddress\Persistence\Base\SpyCompanyUnitAddress;
use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressTableMap;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddressQuery;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiPersistenceFactory getFactory()
 */
class ReturnLabelsRestApiRepository extends AbstractRepository implements ReturnLabelsRestApiRepositoryInterface
{
    /**
     * @param null|string $uuid
     *
     * @return CompanyUnitAddressTransfer
     */
    public function getCompanyUnitAddressByCompanyUnitAddressUuid(string $uuid): ?CompanyUnitAddressTransfer
    {
        /** @var SpyCompanyUnitAddressQuery $spyCompanyUnitAddressQuery */
        $spyCompanyUnitAddressQuery = $this->getFactory()
            ->getCompanyUnitAddressQuery()
            ->clear()
            ->leftJoinCountry()
            ->filterByUuid($uuid);

        $spyCompanyUnitAddressEntity = $spyCompanyUnitAddressQuery->findOne();

        if ($spyCompanyUnitAddressEntity === null) {
            return null;
        }

        return $this->getFactory()
            ->createCompanyUnitAddressMapper()
            ->mapEntityToTransfer($spyCompanyUnitAddressEntity, new CompanyUnitAddressTransfer());
    }
}
