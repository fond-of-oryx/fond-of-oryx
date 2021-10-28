<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer;

interface RestCompanyBusinessUnitAddressSearchAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer
     */
    public function fromCompanyBusinessUnitAddressList(
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): RestCompanyBusinessUnitAddressSearchAttributesTransfer;
}
