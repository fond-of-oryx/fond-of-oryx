<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Persistence;

use FondOfOryx\Zed\ProductCountryRestriction\Persistence\Propel\Mapper\ProductAbstractCountryRestrictionMapper;
use FondOfOryx\Zed\ProductCountryRestriction\Persistence\Propel\Mapper\ProductAbstractCountryRestrictionMapperInterface;
use Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestrictionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionEntityManagerInterface getEntityManager()
 */
class ProductCountryRestrictionPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductCountryRestriction\Persistence\FooProductAbstractCountryRestrictionQuery
     */
    public function createFooProductAbstractCountryRestrictionQuery(): FooProductAbstractCountryRestrictionQuery
    {
        return FooProductAbstractCountryRestrictionQuery::create();
    }

    /**
     * @return \FondOfOryx\Zed\ProductCountryRestriction\Persistence\Propel\Mapper\ProductAbstractCountryRestrictionMapperInterface
     */
    public function createProductAbstractCountryRestrictionMapper(): ProductAbstractCountryRestrictionMapperInterface
    {
        return new ProductAbstractCountryRestrictionMapper();
    }
}
