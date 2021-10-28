<?php

namespace FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi;

use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiFactory getFactory()
 */
class CompanyBusinessUnitAddressSearchRestApiClient extends AbstractClient implements CompanyBusinessUnitAddressSearchRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer
     */
    public function searchCompanyBusinessUnitAddress(
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): CompanyBusinessUnitAddressListTransfer {
        return $this->getFactory()
            ->createZedCompanyBusinessUnitAddressSearchRestApiStub()
            ->searchCompanyBusinessUnitAddress($companyBusinessUnitAddressListTransfer);
    }
}
