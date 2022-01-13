<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Dependecny\Facade;

interface CustomerBrandProductListConnectorToBrandProductListConnectorFacadeInterface
{
    /**
     * @param array<int> $brandIds
     *
     * @return array<int>
     */
    public function getBrandIdsByProductListIds(array $brandIds): array;
}
