<?php

namespace FondOfOryx\Client\CompanyBusinessUnitSearchRestApi;

use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;

interface CompanyBusinessUnitSearchRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer
     */
    public function searchCompanyBusinessUnit(CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer): CompanyBusinessUnitListTransfer;
}
