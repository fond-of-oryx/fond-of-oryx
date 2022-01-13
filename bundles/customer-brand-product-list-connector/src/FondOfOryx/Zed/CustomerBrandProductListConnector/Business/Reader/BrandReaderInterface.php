<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Reader;

use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

interface BrandReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return array<int>
     */
    public function getBrandIdsByCustomerProductListRelation(
        CustomerProductListRelationTransfer $customerProductListRelationTransfer
    ): array;
}
