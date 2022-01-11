<?php

namespace FondOfOryx\Zed\BrandProductListConnector\Persistence;

interface BrandProductListConnectorRepositoryInterface
{
 /**
  * @param array<int> $productListIds
  *
  * @return array<int>
  */
    public function getBrandIdsByProductListIds(array $productListIds): array;
}
