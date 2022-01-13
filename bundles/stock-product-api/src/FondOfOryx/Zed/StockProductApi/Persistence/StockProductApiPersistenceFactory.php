<?php

namespace FondOfOryx\Zed\StockProductApi\Persistence;

use FondOfOryx\Zed\StockProductApi\Persistence\Propel\Mapper\Mapper;
use FondOfOryx\Zed\StockProductApi\Persistence\Propel\Mapper\MapperInterface;
use FondOfOryx\Zed\StockProductApi\StockProductApiDependencyProvider;
use Orm\Zed\Stock\Persistence\SpyStockProductQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\StockProductApi\StockProductApiConfig getConfig()
 * @method \FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiQueryContainer getQueryContainer()
 * @method \FondOfOryx\Zed\StockProductApi\Persistence\StockProductApiRepositoryInterface getRepository()
 */
class StockProductApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \FondOfOryx\Zed\StockProductApi\Persistence\Propel\Mapper\MapperInterface
     */
    public function createMapper(): MapperInterface
    {
        return new Mapper();
    }

    /**
     * @return \Orm\Zed\Stock\Persistence\SpyStockProductQuery
     */
    public function getStockProductQuery(): SpyStockProductQuery
    {
        return $this->getProvidedDependency(StockProductApiDependencyProvider::PROPEL_QUERY_STOCK_PRODUCT);
    }
}
