<?php

namespace FondOfOryx\Zed\StockApi\Persistence;

use FondOfOryx\Zed\StockApi\StockApiDependencyProvider;
use Orm\Zed\Stock\Persistence\SpyStockQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\StockApi\StockApiConfig getConfig()
 * @method \FondOfOryx\Zed\StockApi\Persistence\StockApiQueryContainer getQueryContainer()
 */
class StockApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Stock\Persistence\SpyStockQuery
     */
    public function getStockQuery(): SpyStockQuery
    {
        return $this->getProvidedDependency(StockApiDependencyProvider::PROPEL_QUERY_STOCK);
    }
}
