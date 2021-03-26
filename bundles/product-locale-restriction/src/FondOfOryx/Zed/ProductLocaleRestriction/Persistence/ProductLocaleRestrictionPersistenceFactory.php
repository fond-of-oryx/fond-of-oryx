<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Persistence;

use FondOfOryx\Zed\ProductLocaleRestriction\Persistence\Propel\Mapper\ProductAbstractLocaleRestrictionMapper;
use FondOfOryx\Zed\ProductLocaleRestriction\Persistence\Propel\Mapper\ProductAbstractLocaleRestrictionMapperInterface;
use Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestrictionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionEntityManagerInterface getEntityManager()
 */
class ProductLocaleRestrictionPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductLocaleRestriction\Persistence\FooProductAbstractLocaleRestrictionQuery
     */
    public function createFooProductAbstractLocaleRestrictionQuery(): FooProductAbstractLocaleRestrictionQuery
    {
        return FooProductAbstractLocaleRestrictionQuery::create();
    }

    /**
     * @return \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\Propel\Mapper\ProductAbstractLocaleRestrictionMapperInterface
     */
    public function createProductAbstractLocaleRestrictionMapper(): ProductAbstractLocaleRestrictionMapperInterface
    {
        return new ProductAbstractLocaleRestrictionMapper();
    }
}
