<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use ArrayObject;
use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Generated\Shared\Transfer\CompanyRoleTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchResultItemTransfer;

interface RestCompanyRoleSearchResultItemMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyRoleTransfer $companyRoleTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyRoleSearchResultItemTransfer
     */
    public function fromCompanyRole(CompanyRoleTransfer $companyRoleTransfer): RestCompanyRoleSearchResultItemTransfer;

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\CompanyRoleTransfer> $companyRoleTransfers
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanyRoleSearchResultItemTransfer>
     */
    public function fromCompanyRoleCollection(ArrayObject $companyRoleTransfers): ArrayObject;

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\RestCompanyRoleSearchResultItemTransfer>
     */
    public function fromCompanyRoleList(CompanyRoleListTransfer $companyRoleListTransfer): ArrayObject;
}
