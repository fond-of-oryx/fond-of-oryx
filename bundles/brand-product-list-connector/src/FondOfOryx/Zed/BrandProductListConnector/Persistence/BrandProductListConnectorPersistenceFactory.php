<?php

namespace FondOfOryx\Zed\BrandProductListConnector\Persistence;

use FondOfOryx\Zed\BrandProductListConnector\BrandProductListConnectorDependencyProvider;
use Orm\Zed\BrandProduct\Persistence\Base\FosBrandProductQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\BrandProductListConnector\Persistence\BrandProductListConnectorRepositoryInterface getRepository()
 */
class BrandProductListConnectorPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\BrandProduct\Persistence\Base\FosBrandProductQuery
     */
    public function getBrandProductQuery(): FosBrandProductQuery
    {
        return $this->getProvidedDependency(BrandProductListConnectorDependencyProvider::PROPEL_QUERY_BRAND_PRODUCT);
    }
}
