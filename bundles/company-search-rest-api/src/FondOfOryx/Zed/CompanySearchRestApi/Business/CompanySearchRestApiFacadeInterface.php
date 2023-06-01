<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Business;

use Generated\Shared\Transfer\CompanyListTransfer;

interface CompanySearchRestApiFacadeInterface
{
    /**
     * Specification:
     * - Finds company users by criteria from CompanyListTransfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyListTransfer
     */
    public function findCompanies(CompanyListTransfer $companyListTransfer): CompanyListTransfer;
}
