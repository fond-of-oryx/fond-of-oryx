<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Persistence;

use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorPersistenceFactory getFactory()
 */
class CompanyProductListConnectorRepository extends AbstractRepository implements CompanyProductListConnectorRepositoryInterface
{
    /**
     * @param int $idCompany
     *
     * @return array<int>
     */
    public function getProductListIdsByIdCompany(int $idCompany): array
    {
        return $this->getFactory()
            ->getProductListQuery()
            ->clear()
            ->useSpyProductListCompanyQuery()
                ->filterByFkCompany($idCompany)
            ->endUse()
            ->select([SpyProductListTableMap::COL_ID_PRODUCT_LIST])
            ->find()
            ->toArray();
    }
}
