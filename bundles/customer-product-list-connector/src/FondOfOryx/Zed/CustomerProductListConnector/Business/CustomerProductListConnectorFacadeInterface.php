<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business;

use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

interface CustomerProductListConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Persists relation between customer and product list
     * - Deletes obsolete relations
     * - Creates new relations
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerProductListRelationTransfer $customerProductListRelationTransfer
     *
     * @return void
     */
    public function persistCustomerProductListRelation(
        CustomerProductListRelationTransfer $customerProductListRelationTransfer
    ): void;

    /**
     * Specifications:
     * - Retrieves assigned product list ids by customer id
     *
     * @api
     *
     * @param int $idCustomer
     *
     * @return array<int>
     */
    public function getAssignedProductListIdsByIdCustomer(int $idCustomer): array;
}
