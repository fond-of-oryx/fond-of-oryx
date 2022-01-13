<?php

namespace FondOfOryx\Zed\StockProductApi\Persistence;

use Orm\Zed\Stock\Persistence\SpyStockProductQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiPersistenceFactory getFactory()
 */
class StockProductApiQueryContainer extends AbstractQueryContainer implements StockProductApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Stock\Persistence\SpyStockProductQuery
     */
    public function queryFind(): SpyStockProductQuery
    {
        return $this->getFactory()->getStockProductQuery();
    }
}
