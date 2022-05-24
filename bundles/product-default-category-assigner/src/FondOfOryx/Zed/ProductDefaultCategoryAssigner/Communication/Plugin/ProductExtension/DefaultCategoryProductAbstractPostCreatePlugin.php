<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner\Communication\Plugin\ProductExtension;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductExtension\Dependency\Plugin\ProductAbstractPostCreatePluginInterface;

/**
 * @method \FondOfOryx\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerConfig getConfig()
 * @method \FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\ProductDefaultCategoryAssignerFacadeInterface getFacade()
 */
class DefaultCategoryProductAbstractPostCreatePlugin extends AbstractPlugin implements ProductAbstractPostCreatePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function postCreate(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer
    {
        return $this->getFacade()->assignProductAbstractToDefaultCategory($productAbstractTransfer);
    }
}
