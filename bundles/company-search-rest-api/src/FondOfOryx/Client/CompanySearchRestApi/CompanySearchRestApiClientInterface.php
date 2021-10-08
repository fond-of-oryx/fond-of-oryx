<?php

namespace FondOfOryx\Client\CompanySearchRestApi;

use Generated\Shared\Transfer\CompanyListTransfer;

interface CompanySearchRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyListTransfer
     */
    public function searchCompanies(CompanyListTransfer $companyListTransfer): CompanyListTransfer;
}
