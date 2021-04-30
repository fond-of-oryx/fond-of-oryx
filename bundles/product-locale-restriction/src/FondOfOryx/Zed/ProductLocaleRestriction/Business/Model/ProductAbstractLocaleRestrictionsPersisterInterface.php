<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Business\Model;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface ProductAbstractLocaleRestrictionsPersisterInterface
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
