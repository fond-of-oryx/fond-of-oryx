<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Persistence;

use Generated\Shared\Transfer\ProductAbstractCountryRestrictionTransfer;

interface ProductCountryRestrictionEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProductAbstractCountryRestrictionTransfer $productAbstractCountryRestriction
     *
     * @return void
     */
    public function createProductAbstractCountryRestriction(
        ProductAbstractCountryRestrictionTransfer $productAbstractCountryRestriction
    ): void;

    /**
     * @param int $idProductAbstract
     * @param array<int> $countryIds
     *
     * @return void
     */
    public function deleteProductAbstractCountryRestrictions(
        int $idProductAbstract,
        array $countryIds
    ): void;
}
