<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Persistence;

use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Mapper\ProductPaymentRestrictionMapper;
use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Mapper\ProductPaymentRestrictionMapperInterface;
use Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery;
use Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestrictionQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionEntityManagerInterface getEntityManager()
 */
class ProductPaymentRestrictionPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\ProductPaymentRestriction\Persistence\FooProductAbstractPaymentRestrictionQuery
     */
    public function createFooProductAbstractPaymentRestrictionQuery(): FooProductAbstractPaymentRestrictionQuery
    {
        return FooProductAbstractPaymentRestrictionQuery::create();
    }

    /**
     * @return \Orm\Zed\Payment\Persistence\SpyPaymentMethodQuery
     */
    public function createSpyPaymentMethodQuery(): SpyPaymentMethodQuery
    {
        return SpyPaymentMethodQuery::create();
    }

    /**
     * @return \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Mapper\ProductPaymentRestrictionMapperInterface
     */
    public function createProductAbstractPaymentRestrictionMapper(): ProductPaymentRestrictionMapperInterface
    {
        return new ProductPaymentRestrictionMapper();
    }
}
