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
     * @param array<int> $brandIds
     *
     * @return array<int>
     */
    public function getBrandIdsByProductListIds(array $brandIds): array;
}
