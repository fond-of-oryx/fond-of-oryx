<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Persistence;

use Generated\Shared\Transfer\ProductAbstractLocaleRestrictionTransfer;

interface ProductLocaleRestrictionEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractLocaleRestrictionTransfer $productAbstractLocaleRestriction
     *
     * @return void
     */
    public function createProductAbstractLocaleRestriction(
        ProductAbstractLocaleRestrictionTransfer $productAbstractLocaleRestriction
    ): void;

    /**
     * @param int $idProductAbstract
     * @param int[] $localeIds
     *
     * @return void
     */
    public function deleteProductAbstractLocaleRestrictions(
        int $idProductAbstract,
        array $localeIds
    ): void;
}
