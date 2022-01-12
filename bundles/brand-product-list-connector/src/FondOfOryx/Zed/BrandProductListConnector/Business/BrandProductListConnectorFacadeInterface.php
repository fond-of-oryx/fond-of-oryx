<?php

namespace FondOfOryx\Zed\BrandProductListConnector\Business;

interface BrandProductListConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Find brand ids by product list ids
     *
     * @api
     *
     * @param array<int> $productListIds
     *
     * @return array<int>
     */
    public function getBrandIdsByProductListIds(array $productListIds): array;
}
