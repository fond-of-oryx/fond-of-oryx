<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\RestCompanySearchSortTransfer;

interface RestCompanySearchSortMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchSortTransfer
     */
    public function fromCompanyList(CompanyListTransfer $companyListTransfer): RestCompanySearchSortTransfer;
}
