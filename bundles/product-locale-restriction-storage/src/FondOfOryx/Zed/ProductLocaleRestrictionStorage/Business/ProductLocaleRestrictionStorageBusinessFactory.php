<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business;

use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\Model\ProductAbstractLocaleRestrictionStorageWriter;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\Model\ProductAbstractLocaleRestrictionStorageWriterInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Persistence\ProductLocaleRestrictionStorageRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageConfig getConfig()
 */
class ProductLocaleRestrictionStorageBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Business\Model\ProductAbstractLocaleRestrictionStorageWriterInterface
     */
    public function createProductAbstractLocaleRestrictionStorageWriter(): ProductAbstractLocaleRestrictionStorageWriterInterface
    {
        return new ProductAbstractLocaleRestrictionStorageWriter(
            $this->getProductLocaleRestrictionFacade(),
            $this->getRepository(),
            $this->getConfig()->isSendingToQueue(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface
     */
    protected function getProductLocaleRestrictionFacade(): ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface
    {
        return $this->getProvidedDependency(
            ProductLocaleRestrictionStorageDependencyProvider::FACADE_PRODUCT_LOCALE_RESTRICTION,
        );
    }
}
