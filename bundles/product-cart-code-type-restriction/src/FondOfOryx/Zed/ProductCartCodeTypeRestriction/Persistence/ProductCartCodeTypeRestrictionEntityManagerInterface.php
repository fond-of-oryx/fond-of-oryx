<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Persistence;

use Generated\Shared\Transfer\ProductAbstractCartCodeTypeRestrictionTransfer;

interface ProductCartCodeTypeRestrictionEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractCartCodeTypeRestrictionTransfer $productAbstractCartCodeTypeRestriction
     *
     * @return void
     */
    public function createProductAbstractCartCodeTypeRestriction(
        ProductAbstractCartCodeTypeRestrictionTransfer $productAbstractCartCodeTypeRestriction
    ): void;

    /**
     * @param int $idProductAbstract
     * @param array<int> $cartCodeTypeIds
     *
     * @return void
     */
    public function deleteProductAbstractCartCodeTypeRestrictions(
        int $idProductAbstract,
        array $cartCodeTypeIds
    ): void;
}
