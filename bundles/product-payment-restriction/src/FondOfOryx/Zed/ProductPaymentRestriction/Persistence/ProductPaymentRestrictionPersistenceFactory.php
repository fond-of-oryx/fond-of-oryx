<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Persistence;

use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Mapper\PaymentMethodMapper;
use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Mapper\PaymentMethodMapperInterface;
use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Mapper\ProductPaymentRestrictionMapper;
use FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Mapper\ProductPaymentRestrictionMapperInterface;
use FondOfOryx\Zed\ProductPaymentRestriction\ProductPaymentRestrictionDependencyProvider;
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
    public function getSpyPaymentMethodQuery(): SpyPaymentMethodQuery
    {
        return $this->getProvidedDependency(ProductPaymentRestrictionDependencyProvider::PROPEL_QUERY_PAYMENT_METHOD);
    }

    /**
     * @return \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Mapper\ProductPaymentRestrictionMapperInterface
     */
    public function createProductAbstractPaymentRestrictionMapper(): ProductPaymentRestrictionMapperInterface
    {
        return new ProductPaymentRestrictionMapper();
    }

    /**
     * @return \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\Mapper\PaymentMethodMapperInterface
     */
    public function createPaymentMethodMapper(): PaymentMethodMapperInterface
    {
        return new PaymentMethodMapper();
    }
}
