<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Persistence;

use Orm\Zed\CompanyUnitAddress\Persistence\Map\SpyCompanyUnitAddressTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiPersistenceFactory getFactory()
 */
class ReturnLabelsRestApiRepository extends AbstractRepository implements ReturnLabelsRestApiRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @return int|null
     */
    public function getIdCompanyUnitAddressByCompanyUnitAddressUuid(string $uuid): ?int
    {
        /** @var int|null $idCompanyUnitAddress */
        $idCompanyUnitAddress = $this->getFactory()
            ->getCompanyUnitAddressQuery()
            ->clear()
            ->select([SpyCompanyUnitAddressTableMap::COL_UUID])
            ->findOne();

        return $idCompanyUnitAddress;
    }
}
