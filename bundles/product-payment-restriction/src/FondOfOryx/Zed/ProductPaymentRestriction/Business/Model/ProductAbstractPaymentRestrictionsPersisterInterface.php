<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Business\Model;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface ProductAbstractPaymentRestrictionsPersisterInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return void
     */
    public function persist(
        ProductAbstractTransfer $productAbstractTransfer
    ): void;
}
