<?php

namespace FondOfOryx\Zed\ProductPaymentRestriction\Persistence;

use Generated\Shared\Transfer\ProductAbstractPaymentRestrictionTransfer;

interface ProductPaymentRestrictionEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractPaymentRestrictionTransfer $productAbstractPaymentRestriction
     *
     * @return void
     */
    public function createProductAbstractPaymentRestriction(
        ProductAbstractPaymentRestrictionTransfer $productAbstractPaymentRestriction
    ): void;

    /**
     * @param int $idProductAbstract
     * @param array<int> $localeIds
     *
     * @return void
     */
    public function deleteProductAbstractPaymentRestrictions(
        int $idProductAbstract,
        array $localeIds
    ): void;
}
