<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Dependecny\Facade;

interface CompanyBrandProductListConnectorToBrandProductListConnectorFacadeInterface
{
    /**
     * @param array<int> $brandIds
     *
     * @return array<int>
     */
    public function getBrandIdsByProductListIds(array $brandIds): array;
}
