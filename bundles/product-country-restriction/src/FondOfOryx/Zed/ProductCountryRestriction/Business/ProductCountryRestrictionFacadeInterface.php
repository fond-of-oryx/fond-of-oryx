<?php

namespace FondOfOryx\Zed\ProductCountryRestriction\Business;

use Generated\Shared\Transfer\ProductAbstractTransfer;

interface ProductCountryRestrictionFacadeInterface
{
    /**
     * Specifications:
     * - Persist product abstract country restrictions using provided transfer object.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductAbstractTransfer $productAbstractTransfer
     *
     * @return void
     */
    public function persistProductAbstractCountryRestrictions(ProductAbstractTransfer $productAbstractTransfer): void;

    /**
     * Specifications:
     * - Expand product abstract with blacklisted countries and blacklisted country ids.
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
     * - Retrieves blacklisted countries for product concrete skus.
     * - Returns blacklisted countries (key: product concrete sku, value: array of country codes like DE).
     *
     * @api
     *
     * @param array<string> $productConcreteSkus
     *
     * @return array
     */
    public function getBlacklistedCountriesByProductConcreteSkus(array $productConcreteSkus): array;
}
