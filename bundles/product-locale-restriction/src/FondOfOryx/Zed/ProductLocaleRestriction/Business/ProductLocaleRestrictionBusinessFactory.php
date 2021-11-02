<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Business;

use FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractExpander;
use FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractExpanderInterface;
use FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractLocaleRestrictionsPersister;
use FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractLocaleRestrictionsPersisterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ProductLocaleRestriction\Persistence\ProductLocaleRestrictionRepositoryInterface getRepository()
 */
class ProductLocaleRestrictionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractLocaleRestrictionsPersisterInterface
     */
    public function createProductAbstractLocaleRestrictionsPersister(): ProductAbstractLocaleRestrictionsPersisterInterface
    {
        return new ProductAbstractLocaleRestrictionsPersister(
            $this->getRepository(),
            $this->getEntityManager(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ProductLocaleRestriction\Business\Model\ProductAbstractExpanderInterface
     */
    public function createProductAbstractExpander(): ProductAbstractExpanderInterface
    {
        return new ProductAbstractExpander(
            $this->getRepository(),
        );
    }
}
