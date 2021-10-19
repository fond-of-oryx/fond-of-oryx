<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchSortTransfer;

interface RestCompanyUserSearchSortMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchSortTransfer
     */
    public function fromCompanyUserList(CompanyUserListTransfer $companyUserListTransfer): RestCompanyUserSearchSortTransfer;
}
