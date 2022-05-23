<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner\Business\Model;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface DefaultCategoryAssignerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function assign(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer;
}
