<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business\Persister;

use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

interface CustomerProductListRelationPersisterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return void
     */
    public function persist(CustomerProductListRelationTransfer $customerProductListRelationTransfer): void;
}
