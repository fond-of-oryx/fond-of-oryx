<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Expander;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface ProductAbstractExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function expand(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer;
}
