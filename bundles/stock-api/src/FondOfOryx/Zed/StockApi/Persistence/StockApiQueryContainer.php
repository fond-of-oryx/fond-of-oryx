<?php

namespace FondOfOryx\Zed\StockApi\Persistence;

use Orm\Zed\Stock\Persistence\SpyStockQuery;
use Spryker\Zed\Kernel\Persistence\AbstractQueryContainer;

/**
 * @method \FondOfOryx\Zed\StockApi\Persistence\StockApiPersistenceFactory getFactory()
 */
class StockApiQueryContainer extends AbstractQueryContainer implements StockApiQueryContainerInterface
{
    /**
     * @return \Orm\Zed\Stock\Persistence\SpyStockQuery
     */
    public function queryFind(): SpyStockQuery
    {
        return $this->getFactory()->getStockQuery();
    }
}
