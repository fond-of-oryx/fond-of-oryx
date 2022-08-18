<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Persistence;

use FondOfOryx\Zed\VertigoPriceProductPriceList\VertigoPriceProductPriceListDependencyProvider;
use Orm\Zed\Product\Persistence\Base\SpyProductQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class VertigoPriceProductPriceListPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Product\Persistence\Base\SpyProductQuery
     */
    public function getProductQuery(): SpyProductQuery
    {
        return $this->getProvidedDependency(VertigoPriceProductPriceListDependencyProvider::PROPEL_QUERY_PRODUCT);
    }
}
