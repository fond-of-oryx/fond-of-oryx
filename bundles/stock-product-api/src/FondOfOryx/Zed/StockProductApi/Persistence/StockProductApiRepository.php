<?php

namespace FondOfOryx\Zed\StockProductApi\Persistence;

use Generated\Shared\Transfer\StockProductTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiPersistenceFactory getFactory()
 */
class StockProductApiRepository extends AbstractRepository implements StockProductApiRepositoryInterface
{
    /**
     * @param int $idStockProduct
     *
     * @return \Generated\Shared\Transfer\StockProductTransfer|null
     */
    public function getStockProductById(int $idStockProduct): ?StockProductTransfer
    {
        $query = $this->getFactory()->getStockProductQuery();
        $query->joinSpyProduct()->leftJoinWithStock();
        $entity = $query->findOneByIdStockProduct($idStockProduct);

        return $entity === null ? null : $this->getFactory()->createMapper()->fromEntity($entity);
    }
}
