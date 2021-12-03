<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business\Persister;

use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

interface CompanyProductListRelationPersisterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyProductListRelationTransfer $companyProductListRelationTransfer
     *
     * @return void
     */
    public function persist(CompanyProductListRelationTransfer $companyProductListRelationTransfer): void;
}
