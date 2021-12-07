<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business;

use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

interface CompanyProductListConnectorFacadeInterface
{
    /**
     * Specifications:
     * - Persists relation between company and product list
     * - Deletes obsolete relations
     * - Creates new relations
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return void
     */
    public function persistCompanyProductListRelation(
        CompanyProductListRelationTransfer $companyProductListRelationTransfer
    ): void;

    /**
     * Specifications:
     * - Retrieves assigned product list ids by company id
     *
     * @api
     *
     * @param int $idCompany
     *
     * @return array<int>
     */
    public function getAssignedProductListIdsByIdCompany(int $idCompany): array;
}
