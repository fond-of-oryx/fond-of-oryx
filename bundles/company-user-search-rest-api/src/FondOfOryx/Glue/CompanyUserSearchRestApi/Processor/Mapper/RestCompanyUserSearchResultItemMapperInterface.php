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
     * @param \ArrayObject<\Generated\Shared\Transfer\CompanyUserTransfer> $companyUserTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanyUserSearchResultItemTransfer>
     */
    public function fromCompanyUserCollection(ArrayObject $companyUserTransfers): ArrayObject;

    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanyUserSearchResultItemTransfer>
     */
    public function fromCompanyUserList(CompanyUserListTransfer $companyUserListTransfer): ArrayObject;
}
