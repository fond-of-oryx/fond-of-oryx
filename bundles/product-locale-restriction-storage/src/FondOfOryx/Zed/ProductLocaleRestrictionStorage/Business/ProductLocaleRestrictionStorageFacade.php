<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business;

use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\ProductLocaleRestrictionStorageBusinessFactory getFactory()
 */
class ProductLocaleRestrictionStorageFacade extends AbstractFacade implements ProductLocaleRestrictionStorageFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array<int> $productAbstractIds
     *
     * @return void
     */
    public function publish(array $productAbstractIds): void
    {
        $this->getFactory()->createProductAbstractLocaleRestrictionStorageWriter()->publish($productAbstractIds);
    }
}
