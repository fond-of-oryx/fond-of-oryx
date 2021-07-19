<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business;

use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Expander\ProductAbstractExpander;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Expander\ProductAbstractExpanderInterface;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Persister\ProductAbstractCartCodeTypeRestrictionsPersister;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Persister\ProductAbstractCartCodeTypeRestrictionsPersisterInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence\ProductCartCodeTypeRestrictionRepositoryInterface getRepository()
 */
class ProductCartCodeTypeRestrictionBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Persister\ProductAbstractCartCodeTypeRestrictionsPersisterInterface
     */
    public function createProductAbstractCartCodeTypeRestrictionsPersister(): ProductAbstractCartCodeTypeRestrictionsPersisterInterface
    {
        return new ProductAbstractCartCodeTypeRestrictionsPersister(
            $this->getRepository(),
            $this->getEntityManager()
        );
    }

    /**
     * @return \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Expander\ProductAbstractExpanderInterface
     */
    public function createProductAbstractExpander(): ProductAbstractExpanderInterface
    {
        return new ProductAbstractExpander(
            $this->getRepository()
        );
    }
}
