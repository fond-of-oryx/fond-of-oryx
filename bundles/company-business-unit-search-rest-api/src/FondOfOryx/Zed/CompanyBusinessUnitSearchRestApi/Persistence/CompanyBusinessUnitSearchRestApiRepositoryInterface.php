<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitSearchRestApi\Persistence;

use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;

interface CompanyBusinessUnitSearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer
     */
    public function searchCompanyBusinessUnit(CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer): CompanyBusinessUnitListTransfer;
}
