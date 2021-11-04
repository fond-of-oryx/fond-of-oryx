<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchResultItemTransfer;

class RestCompanyRoleSearchResultItemMapper implements RestCompanyRoleSearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleTransfer $companyRoleTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleSearchResultItemTransfer
     */
    public function fromCompanyRole(CompanyRoleTransfer $companyRoleTransfer): RestCompanyRoleSearchResultItemTransfer
    {
        return (new RestCompanyRoleSearchResultItemTransfer())->fromArray(
            $companyRoleTransfer->toArray(),
            true,
        )->setCompanyUuid($companyRoleTransfer->getCompanyUuid());
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\CompanyRoleTransfer> $companyRoleTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanyRoleSearchResultItemTransfer>
     */
    public function fromCompanyRoleCollection(ArrayObject $companyRoleTransfers): ArrayObject
    {
        $restCompaniesAttributesTransfers = new ArrayObject();

        foreach ($companyRoleTransfers as $companyRoleTransfer) {
            $restCompaniesAttributesTransfers->append($this->fromCompanyRole($companyRoleTransfer));
        }

        return $restCompaniesAttributesTransfers;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanyRoleSearchResultItemTransfer>
     */
    public function fromCompanyRoleList(CompanyRoleListTransfer $companyRoleListTransfer): ArrayObject
    {
        return $this->fromCompanyRoleCollection($companyRoleListTransfer->getCompanyRole());
    }
}
