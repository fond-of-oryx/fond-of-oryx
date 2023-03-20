<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business\Deleter;

use Generated\Shared\Transfer\CompanyCollectionTransfer;

interface CompanyDeleterInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyCollectionTransfer $companyCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function deleteCompanies(CompanyCollectionTransfer $companyCollectionTransfer): CompanyCollectionTransfer;
}
