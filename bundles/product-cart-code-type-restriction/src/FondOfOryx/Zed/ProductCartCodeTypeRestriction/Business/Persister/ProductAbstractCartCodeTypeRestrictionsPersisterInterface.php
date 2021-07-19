<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\Persister;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface ProductAbstractCartCodeTypeRestrictionsPersisterInterface
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
