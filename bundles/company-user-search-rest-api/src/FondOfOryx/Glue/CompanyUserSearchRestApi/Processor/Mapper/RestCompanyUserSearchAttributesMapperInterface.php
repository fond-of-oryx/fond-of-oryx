<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer;

interface RestCompanyUserSearchAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer
     */
    public function fromCompanyUserList(CompanyUserListTransfer $companyUserListTransfer): RestCompanyUserSearchAttributesTransfer;
}
