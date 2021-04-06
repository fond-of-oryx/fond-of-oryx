<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Business\Model;

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
