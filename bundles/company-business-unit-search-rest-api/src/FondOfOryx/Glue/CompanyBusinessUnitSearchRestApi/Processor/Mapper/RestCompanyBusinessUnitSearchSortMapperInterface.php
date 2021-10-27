<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchSortTransfer;

interface RestCompanyBusinessUnitSearchSortMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchSortTransfer
     */
    public function fromCompanyBusinessUnitList(CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer): RestCompanyBusinessUnitSearchSortTransfer;
}
