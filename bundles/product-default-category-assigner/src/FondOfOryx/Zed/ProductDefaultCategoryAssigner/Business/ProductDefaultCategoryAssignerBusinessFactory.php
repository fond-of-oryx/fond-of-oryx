<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business;

use FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\Model\DefaultCategoryAssigner;
use FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\Model\DefaultCategoryAssignerInterface;
use FondOfOryx\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface;
use FondOfOryx\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig getConfig()
 */
class ProductDefaultCategoryAssignerBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\Model\DefaultCategoryAssignerInterface
     */
    public function createDefaultCategoryAssigner(): DefaultCategoryAssignerInterface
    {
        return new DefaultCategoryAssigner(
            $this->getConfig(),
            $this->getProductCategoryFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeInterface
     */
    protected function getProductCategoryFacade(): ProductDefaultCategoryAssignerToProductCategoryFacadeInterface
    {
        return $this->getProvidedDependency(ProductDefaultCategoryAssignerDependencyProvider::FACADE_PRODUCT_CATEGORY);
    }
}
