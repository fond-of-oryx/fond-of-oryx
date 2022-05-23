<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface ProductDefaultCategoryAssignerFacadeInterface
{
    /**
     * Specifications:
     * - Adds product abstract to default category
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function assignProductAbstractToDefaultCategory(
        ProductAbstractTransfer $productAbstractTransfer
    ): ProductAbstractTransfer;
}
