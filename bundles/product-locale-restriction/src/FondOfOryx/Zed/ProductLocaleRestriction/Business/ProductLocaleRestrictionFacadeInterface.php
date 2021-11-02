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

    /**
     * Specifications:
     * - Retrieves blacklisted locales for product abstract ids.
     * - Returns blacklisted locales (key: product abstract id, value: array of locale names like de_DE).
     *
     * @api
     *
     * @param array<int> $productAbstractIds
     *
     * @return array
     */
    public function getBlacklistedLocalesByProductAbstractIds(array $productAbstractIds): array;

    /**
     * Specifications:
     * - Retrieves blacklisted locales for product concrete skus.
     * - Returns blacklisted locales (key: product concrete sku, value: array of locale names like de_DE).
     *
     * @api
     *
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedLocalesByProductConcreteSkus(array $productConcreteSkus): array;
}
