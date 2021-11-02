<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchResultItemTransfer;

class RestCompanyUserSearchResultItemMapper implements RestCompanyUserSearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyUserSearchResultItemTransfer
     */
    public function fromCompanyUser(CompanyUserTransfer $companyUserTransfer): RestCompanyUserSearchResultItemTransfer
    {
        return (new RestCompanyUserSearchResultItemTransfer())->fromArray(
            $companyUserTransfer->toArray(),
            true,
        )->setCompanyId($companyUserTransfer->getCompanyUuid());
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\CompanyUserTransfer> $companyUserTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanyUserSearchResultItemTransfer>
     */
    public function fromCompanyUserCollection(ArrayObject $companyUserTransfers): ArrayObject
    {
        $restCompaniesAttributesTransfers = new ArrayObject();

        foreach ($companyUserTransfers as $companyUserTransfer) {
            $restCompaniesAttributesTransfers->append($this->fromCompanyUser($companyUserTransfer));
        }

        return $restCompaniesAttributesTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanyUserSearchResultItemTransfer>
     */
    public function fromCompanyUserList(CompanyUserListTransfer $companyUserListTransfer): ArrayObject
    {
        return $this->fromCompanyUserCollection($companyUserListTransfer->getCompanyUser());
    }
}
