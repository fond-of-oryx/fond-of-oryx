<?php

namespace FondOfOryx\Zed\CompanySearchRestApi\Persistence;

use Generated\Shared\Transfer\CompanyListTransfer;

interface CompanySearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyListTransfer
     */
    public function searchCompanies(CompanyListTransfer $companyListTransfer): CompanyListTransfer;
}
