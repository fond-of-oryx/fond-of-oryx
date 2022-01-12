<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Business\Persister;

use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

interface CompanyBrandRelationPersisterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return void
     */
    public function persistByCompanyProductListRelation(
        CompanyProductListRelationTransfer $companyProductListRelationTransfer
    ): void;
}
