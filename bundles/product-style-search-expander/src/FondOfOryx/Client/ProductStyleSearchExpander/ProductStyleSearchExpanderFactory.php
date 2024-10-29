<?php

namespace FondOfOryx\Client\ProductStyleSearchExpander;

use FondOfOryx\Client\ProductStyleSearchExpander\Dependency\Client\ProductStyleSearchExpanderToCatalogClientInterface;
use Spryker\Client\Kernel\AbstractFactory;
use Spryker\Client\SearchElasticsearch\Query\QueryBuilder;
use Spryker\Client\SearchElasticsearch\Query\QueryBuilderInterface;

class ProductStyleSearchExpanderFactory extends AbstractFactory
{
    /**
     * @return \Spryker\Client\SearchElasticsearch\Query\QueryBuilder
     */
    public function createQueryBuilder(): QueryBuilderInterface
    {
        return new QueryBuilder();
    }

    /**
     * @return \FondOfOryx\Client\ProductStyleSearchExpander\Dependency\Client\ProductStyleSearchExpanderToCatalogClientInterface
     */
    public function getCatalogClient(): ProductStyleSearchExpanderToCatalogClientInterface
    {
        return $this->getProvidedDependency(ProductStyleSearchExpanderDependencyProvider::CLIENT_CATALOG);
    }
}
