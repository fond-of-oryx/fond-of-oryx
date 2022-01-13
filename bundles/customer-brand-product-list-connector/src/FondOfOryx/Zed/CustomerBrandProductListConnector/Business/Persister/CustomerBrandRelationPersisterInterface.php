<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Persister;

use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

interface CustomerBrandRelationPersisterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return void
     */
    public function persistByCustomerProductListRelation(
        CustomerProductListRelationTransfer $customerProductListRelationTransfer
    ): void;
}
