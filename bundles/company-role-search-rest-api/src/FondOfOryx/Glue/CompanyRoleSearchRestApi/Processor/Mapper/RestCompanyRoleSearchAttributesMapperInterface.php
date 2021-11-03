<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer;

interface RestCompanyRoleSearchAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleSearchAttributesTransfer
     */
    public function fromCompanyRoleList(
        CompanyRoleListTransfer $companyRoleListTransfer
    ): RestCompanyRoleSearchAttributesTransfer;
}
