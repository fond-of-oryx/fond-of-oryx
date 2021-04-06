<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Business\Model;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface ProductAbstractCountryRestrictionsPersisterInterface
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
