<?php

namespace FondOfOryx\Zed\ProductLocaleRestriction\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface ProductLocaleRestrictionFacadeInterface
{
    /**
     * Specifications:
     * - Persist product abstract locale restrictions using provided transfer object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return void
     */
    public function persistProductAbstractLocaleRestrictions(ProductAbstractTransfer $productAbstractTransfer): void;

    /**
     * Specifications:
     * - Expand product abstract with blacklisted locales and blacklisted locale ids.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function expandProductAbstract(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer;
}
