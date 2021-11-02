<?php

namespace FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface ProductCartCodeTypeRestrictionFacadeInterface
{
    /**
     * Specifications:
     * - Persist product abstract cart code type restrictions using provided transfer object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return void
     */
    public function persistProductAbstractCartCodeTypeRestrictions(
        ProductAbstractTransfer $productAbstractTransfer
    ): void;

    /**
     * Specifications:
     * - Expand product abstract with blacklisted cart code types and blacklisted cart code type ids.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return \Generated\Shared\Transfer\ProductAbstractTransfer
     */
    public function expandProductAbstract(ProductAbstractTransfer $productAbstractTransfer): ProductAbstractTransfer;

    /**
     * Specifications:
     * - Retrieves blacklisted cart code types for product concrete skus.
     * - Returns blacklisted cart code types (key: product concrete sku, value: array of cart code type names).
     *
     * @api
     *
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedCartCodeTypesByProductConcreteSkus(array $productConcreteSkus): array;
}
