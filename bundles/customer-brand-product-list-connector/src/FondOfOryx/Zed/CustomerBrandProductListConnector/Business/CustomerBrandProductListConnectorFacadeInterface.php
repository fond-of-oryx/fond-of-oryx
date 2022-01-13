<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Business;

use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

interface CustomerBrandProductListConnectorFacadeInterface
{
    /**
     * Specifications
     * - Persists relation between customer and brand by customer product list relation
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return void
     */
    public function persistCustomerBrandRelationByCustomerProductListRelation(
        CustomerProductListRelationTransfer $customerProductListRelationTransfer
    ): void;
}
