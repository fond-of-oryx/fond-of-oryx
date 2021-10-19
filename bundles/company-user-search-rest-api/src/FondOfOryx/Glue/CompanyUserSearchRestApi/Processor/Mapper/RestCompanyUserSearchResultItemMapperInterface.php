<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchResultItemTransfer;

interface RestCompanyUserSearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchResultItemTransfer
     */
    public function fromCompanyUser(CompanyUserTransfer $companyUserTransfer): RestCompanyUserSearchResultItemTransfer;

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer[]|\ArrayObject $companyUserTransfers
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyUserCollection(ArrayObject $companyUserTransfers): ArrayObject;

    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchResultItemTransfer[]|\ArrayObject
     */
    public function fromCompanyUserList(CompanyUserListTransfer $companyUserListTransfer): ArrayObject;
}
