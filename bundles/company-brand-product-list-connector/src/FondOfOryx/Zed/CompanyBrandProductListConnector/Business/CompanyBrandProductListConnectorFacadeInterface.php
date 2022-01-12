<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Business;

use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

interface CompanyBrandProductListConnectorFacadeInterface
{
    /**
     * Specifications
     * - Persists relation between company and brand by company product list relation
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return void
     */
    public function persistCompanyBrandRelationByCompanyProductListRelation(
        CompanyProductListRelationTransfer $companyProductListRelationTransfer
    ): void;
}
