<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence;

use Orm\Zed\ProductLocaleRestrictionStorage\Persistence\FooProductAbstractLocaleRestrictionStorageQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepositoryInterface getRepository()
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
