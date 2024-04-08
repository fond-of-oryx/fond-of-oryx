<?php

namespace FondOfOryx\Zed\ProductPageSearchAttributeExpander\Business;

use FondOfOryx\Zed\ProductPageSearchAttributeExpander\Business\Model\ProductPageDataExpander;
use FondOfOryx\Zed\ProductPageSearchAttributeExpander\Business\Model\ProductPageDataExpanderInterface;
use FondOfOryx\Zed\ProductPageSearchAttributeExpander\Dependency\Facade\ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface;
use FondOfOryx\Zed\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderDependencyProvider;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\ProductPageSearchAttributeExpander\ProductPageSearchAttributeExpanderConfig getConfig()
 */
class ProductPageSearchAttributeExpanderBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\ProductPageSearchAttributeExpander\Business\Model\ProductPageDataExpanderInterface
     */
    public function createProductPageDataExpander(): ProductPageDataExpanderInterface
    {
        return new ProductPageDataExpander($this->getProductAttributeFacade());
    }

    /**
     * @return \FondOfOryx\Zed\ProductPageSearchAttributeExpander\Dependency\Facade\ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface
     */
    protected function getProductAttributeFacade(): ProductPageSearchAttributeExpanderToProductAttributeFacadeInterface
    {
        return $this->getProvidedDependency(ProductPageSearchAttributeExpanderDependencyProvider::FACADE_PRODUCT_ATTRIBUTE);
    }
}
