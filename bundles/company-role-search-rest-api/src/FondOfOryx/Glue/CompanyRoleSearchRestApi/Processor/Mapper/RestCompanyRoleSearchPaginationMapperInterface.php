<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchPaginationTransfer;

interface RestCompanyRoleSearchPaginationMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleSearchPaginationTransfer
     */
    public function fromCompanyRoleList(
        CompanyRoleListTransfer $companyRoleListTransfer
    ): RestCompanyRoleSearchPaginationTransfer;
}
