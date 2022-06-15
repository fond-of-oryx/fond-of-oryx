<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade;

use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

interface CompanyProductListApiToCompanyProductListConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return void
     */
    public function persistCompanyProductListRelation(
        CompanyProductListRelationTransfer $companyProductListRelationTransfer
    ): void;
}
