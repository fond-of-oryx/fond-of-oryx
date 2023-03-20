<?php

namespace FondOfOryx\Client\CompaniesRestApi\Zed;

use Generated\Shared\Transfer\CompanyCollectionTransfer;

interface CompaniesRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyCollectionTransfer $companyCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function deleteCompanies(CompanyCollectionTransfer $companyCollectionTransfer): CompanyCollectionTransfer;
}
