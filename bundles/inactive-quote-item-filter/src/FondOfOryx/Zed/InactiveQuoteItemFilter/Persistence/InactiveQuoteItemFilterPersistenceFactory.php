<?php

namespace FondOfOryx\Zed\InactiveQuoteItemFilter\Persistence;

use FondOfOryx\Zed\InactiveQuoteItemFilter\InactiveQuoteItemFilterDependencyProvider;
use Orm\Zed\Product\Persistence\Base\SpyProductQuery as BaseSpyProductQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 */
class InactiveQuoteItemFilterPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Product\Persistence\Base\SpyProductQuery
     */
    public function getProductQuery(): BaseSpyProductQuery
    {
        return $this->getProvidedDependency(InactiveQuoteItemFilterDependencyProvider::PROPEL_QUERY_PRODUCT);
    }
}
