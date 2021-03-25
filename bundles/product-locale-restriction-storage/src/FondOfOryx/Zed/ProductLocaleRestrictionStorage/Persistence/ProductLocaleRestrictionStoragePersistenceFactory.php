<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence;

use Orm\Zed\ProductLocaleRestrictionStorage\Persistence\FooProductAbstractLocaleRestrictionStorageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig getConfig()
 */
class ProductLocaleRestrictionStoragePersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductLocaleRestrictionStorage\Persistence\FooProductAbstractLocaleRestrictionStorageQuery
     */
    public function createFooProductAbstractLocaleRestrictionStorageQuery(): FooProductAbstractLocaleRestrictionStorageQuery
    {
        return FooProductAbstractLocaleRestrictionStorageQuery::create();
    }
}
