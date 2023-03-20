<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business;

use Generated\Shared\Transfer\CompanyCollectionTransfer;

interface CompaniesRestApiFacadeInterface
{
    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyCollectionTransfer $companyCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function deleteCompanies(CompanyCollectionTransfer $companyCollectionTransfer): CompanyCollectionTransfer;
}
