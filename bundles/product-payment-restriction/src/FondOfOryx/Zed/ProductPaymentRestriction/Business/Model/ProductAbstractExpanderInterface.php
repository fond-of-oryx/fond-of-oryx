<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business\Model;

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
