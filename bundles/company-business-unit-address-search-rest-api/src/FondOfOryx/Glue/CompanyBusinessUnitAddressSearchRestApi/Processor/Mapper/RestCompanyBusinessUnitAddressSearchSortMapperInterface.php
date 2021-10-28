<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchSortTransfer;

interface RestCompanyBusinessUnitAddressSearchSortMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchSortTransfer
     */
    public function fromCompanyBusinessUnitAddressList(
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): RestCompanyBusinessUnitAddressSearchSortTransfer;
}
