<?php

namespace FondOfOryx\Zed\ProductPageSearchAttributeExpander\Business;

use Generated\Shared\Transfer\ProductPageSearchTransfer;

interface ProductPageSearchAttributeExpanderFacadeInterface
{
    /**
     * Specification:
     * - Expands product page date with localized/default attributes.
     * - Returns expanded product page data.
     *
     * @api
     *
     * @param array $productPage
     * @param \Generated\Shared\Transfer\ProductPageSearchTransfer $productAbstractPageSearchTransfer
     *
     * @return array
     */
    public function expandProductPageData(
        array $productPage,
        ProductPageSearchTransfer $productAbstractPageSearchTransfer
    ): array;
}
