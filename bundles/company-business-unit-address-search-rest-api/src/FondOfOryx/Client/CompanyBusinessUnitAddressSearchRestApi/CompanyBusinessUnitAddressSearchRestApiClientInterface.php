<?php

namespace FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi;

use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;

interface CompanyBusinessUnitAddressSearchRestApiClientInterface
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
