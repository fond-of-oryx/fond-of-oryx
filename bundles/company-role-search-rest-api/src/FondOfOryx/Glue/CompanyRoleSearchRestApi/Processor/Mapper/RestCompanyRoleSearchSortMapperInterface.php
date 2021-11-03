<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchSortTransfer;

interface RestCompanyRoleSearchSortMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleSearchSortTransfer
     */
    public function fromCompanyRoleList(
        CompanyRoleListTransfer $companyRoleListTransfer
    ): RestCompanyRoleSearchSortTransfer;
}
