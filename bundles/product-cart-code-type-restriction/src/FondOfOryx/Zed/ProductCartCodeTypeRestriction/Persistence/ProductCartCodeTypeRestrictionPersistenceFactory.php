<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence;

use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\Propel\Mapper\ProductAbstractCartCodeTypeRestrictionMapper;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\Propel\Mapper\ProductAbstractCartCodeTypeRestrictionMapperInterface;
use Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestrictionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionEntityManagerInterface getEntityManager()
 */
class ProductCartCodeTypeRestrictionPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductCartCodeTypeRestriction\Persistence\FooProductAbstractCartCodeTypeRestrictionQuery
     */
    public function createFooProductAbstractCartCodeTypeRestrictionQuery(): FooProductAbstractCartCodeTypeRestrictionQuery
    {
        return FooProductAbstractCartCodeTypeRestrictionQuery::create();
    }

    /**
     * @return \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\Propel\Mapper\ProductAbstractCartCodeTypeRestrictionMapperInterface
     */
    public function createProductAbstractCartCodeTypeRestrictionMapper(): ProductAbstractCartCodeTypeRestrictionMapperInterface
    {
        return new ProductAbstractCartCodeTypeRestrictionMapper();
    }
}
