<?php

namespace FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Zed;

use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;

interface CompanyBusinessUnitAddressSearchRestApiStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer
     */
    public function searchCompanyBusinessUnitAddress(
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): CompanyBusinessUnitAddressListTransfer;
}
