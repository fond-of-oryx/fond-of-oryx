<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business;

use FondOfOryx\Zed\ProductPaymentRestriction\Business\Model\ProductAbstractExpander;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\Model\ProductAbstractExpanderInterface;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\Model\ProductAbstractPaymentRestrictionsPersister;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\Model\ProductAbstractPaymentRestrictionsPersisterInterface;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter\ProductPaymentRestrictionPaymentMethodFilter;
use FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter\ProductPaymentRestrictionPaymentMethodFilterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\ProductPaymentRestrictionConfig getConfig()
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ProductPaymentRestriction\Persistence\ProductPaymentRestrictionEntityManagerInterface getEntityManager()()
 */
class ProductPaymentRestrictionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductPaymentRestriction\Business\PaymentMethodFilter\ProductPaymentRestrictionPaymentMethodFilterInterface
     */
    public function createProductPaymentRestrictionPaymentMethodFilter(): ProductPaymentRestrictionPaymentMethodFilterInterface
    {
        return new ProductPaymentRestrictionPaymentMethodFilter($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ProductPaymentRestriction\Business\Model\ProductAbstractExpanderInterface
     */
    public function createProductAbstractExpander(): ProductAbstractExpanderInterface
    {
        return new ProductAbstractExpander($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\ProductPaymentRestriction\Business\Model\ProductAbstractPaymentRestrictionsPersisterInterface
     */
    public function createProductAbstractPaymentRestrictionsPersister(): ProductAbstractPaymentRestrictionsPersisterInterface
    {
        return new ProductAbstractPaymentRestrictionsPersister($this->getRepository(), $this->getEntityManager());
    }
}
