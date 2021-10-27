<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchPaginationTransfer;

interface RestCompanyBusinessUnitSearchPaginationMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchPaginationTransfer
     */
    public function fromCompanyBusinessUnitList(
        CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
    ): RestCompanyBusinessUnitSearchPaginationTransfer;
}
