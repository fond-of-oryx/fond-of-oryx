<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner\Communication\Plugin\Product;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Product\Dependency\Plugin\ProductAbstractPluginCreateInterface;

/**
 * @method \FondOfOryx\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig getConfig()
 * @method \FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\ProductDefaultCategoryAssignerFacadeInterface getFacade()
 */
class DefaultCategoryProductAbstractAfterCreatePlugin extends AbstractPlugin implements ProductAbstractPluginCreateInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function create(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        return $this->getFacade()->assignProductAbstractToDefaultCategory($productAbstractTransfer);
    }
}
