<?php

namespace FondOfOryx\Zed\CompanyDeleterCompanyToProductListConnector\Persistence;

use Orm\Zed\ProductList\Persistence\SpyProductListCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompanyDeleterCompanyToProductListConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListCompanyQuery
     */
    public function createSpyProductListCompanyQuery(): SpyProductListCompanyQuery
    {
        return SpyProductListCompanyQuery::create();
    }
}
