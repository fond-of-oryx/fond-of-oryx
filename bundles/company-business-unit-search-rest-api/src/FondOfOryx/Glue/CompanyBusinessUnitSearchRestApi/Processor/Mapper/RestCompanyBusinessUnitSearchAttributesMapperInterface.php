<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer;

interface RestCompanyBusinessUnitSearchAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer
     */
    public function fromCompanyBusinessUnitList(
        CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
    ): RestCompanyBusinessUnitSearchAttributesTransfer;
}
