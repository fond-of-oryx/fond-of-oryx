<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Business;

use FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractCountryRestrictionsPersister;
use FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractCountryRestrictionsPersisterInterface;
use FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractExpander;
use FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractExpanderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ProductCountryRestriction\Persistence\ProductCountryRestrictionRepositoryInterface getRepository()
 */
class ProductCountryRestrictionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractCountryRestrictionsPersisterInterface
     */
    public function createProductAbstractCountryRestrictionsPersister(): ProductAbstractCountryRestrictionsPersisterInterface
    {
        return new ProductAbstractCountryRestrictionsPersister(
            $this->getRepository(),
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ProductCountryRestriction\Business\Model\ProductAbstractExpanderInterface
     */
    public function createProductAbstractExpander(): ProductAbstractExpanderInterface
    {
        return new ProductAbstractExpander(
            $this->getRepository()
        );
    }
}
