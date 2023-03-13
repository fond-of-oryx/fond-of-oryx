<?php

namespace FondOfOryx\Zed\CompanyDeleterProductListConnector\Persistence;

use Orm\Zed\ProductList\Persistence\SpyProductListCompanyQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

class CompanyDeleterProductListConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductList\Persistence\SpyProductListCompanyQuery
     */
    public function createSpyProductListCompanyQuery(): SpyProductListCompanyQuery
    {
        return SpyProductListCompanyQuery::create();
    }
}
