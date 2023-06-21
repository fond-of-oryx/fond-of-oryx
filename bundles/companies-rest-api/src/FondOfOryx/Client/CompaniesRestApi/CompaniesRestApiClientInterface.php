<?php

namespace FondOfOryx\Client\CompaniesRestApi;

use Generated\Shared\Transfer\CompanyTransfer;

interface CompaniesRestApiClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function deleteCompany(CompanyTransfer $companyTransfer): CompanyTransfer;
}
