<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Persistence;

use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorPersistenceFactory getFactory()
 */
class CustomerProductListConnectorRepository extends AbstractRepository implements CustomerProductListConnectorRepositoryInterface
{
    /**
     * @param int $idCustomer
     *
     * @return array<int>
     */
    public function getProductListIdsByIdCustomer(int $idCustomer): array
    {
        /** @var \Propel\Runtime\Collection\ArrayCollection $productListCollection */
        $productListCollection = $this->getFactory()
            ->getProductListQuery()
            ->clear()
            ->useSpyProductListCustomerQuery()
                ->filterByFkCustomer($idCustomer)
            ->endUse()
            ->select([SpyProductListTableMap::COL_ID_PRODUCT_LIST])
            ->find();

        return $productListCollection->toArray();
    }
}
