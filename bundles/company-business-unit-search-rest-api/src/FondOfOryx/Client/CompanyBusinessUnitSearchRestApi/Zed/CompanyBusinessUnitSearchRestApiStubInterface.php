<?php

namespace FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Zed;

use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;

interface CompanyBusinessUnitSearchRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer
     */
    public function searchCompanyBusinessUnit(CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer): CompanyBusinessUnitListTransfer;
}
