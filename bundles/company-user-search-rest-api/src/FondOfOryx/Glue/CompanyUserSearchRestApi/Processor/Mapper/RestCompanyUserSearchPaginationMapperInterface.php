<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchPaginationTransfer;

interface RestCompanyUserSearchPaginationMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchPaginationTransfer
     */
    public function fromCompanyUserList(CompanyUserListTransfer $companyUserListTransfer): RestCompanyUserSearchPaginationTransfer;
}
