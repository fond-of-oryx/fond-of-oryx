<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\ProductDefaultCategoryAssignerBusinessFactory getFactory()
 */
class ProductDefaultCategoryAssignerFacade extends AbstractFacade implements ProductDefaultCategoryAssignerFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function assignProductAbstractToDefaultCategory(
        ProductAbstractTransfer $productAbstractTransfer
    ): ProductAbstractTransfer {
        return $this->getFactory()->createDefaultCategoryAssigner()->assign($productAbstractTransfer);
    }
}
