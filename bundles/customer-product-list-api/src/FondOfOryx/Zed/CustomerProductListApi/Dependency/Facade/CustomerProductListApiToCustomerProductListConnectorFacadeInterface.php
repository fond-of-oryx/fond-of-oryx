<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade;

use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

interface CustomerProductListApiToCustomerProductListConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return void
     */
    public function persistCustomerProductListRelation(
        CustomerProductListRelationTransfer $customerProductListRelationTransfer
    ): void;
}
