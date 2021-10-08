<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\RestCompanySearchPaginationTransfer;

interface RestCompanySearchPaginationMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanySearchPaginationTransfer
     */
    public function fromCompanyList(CompanyListTransfer $companyListTransfer): RestCompanySearchPaginationTransfer;
}
