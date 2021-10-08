<?php

namespace FondOfOryx\Client\CompanySearchRestApi\Zed;

use Generated\Shared\Transfer\CompanyListTransfer;

interface CompanySearchRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyListTransfer
     */
    public function searchCompanies(CompanyListTransfer $companyListTransfer): CompanyListTransfer;
}
