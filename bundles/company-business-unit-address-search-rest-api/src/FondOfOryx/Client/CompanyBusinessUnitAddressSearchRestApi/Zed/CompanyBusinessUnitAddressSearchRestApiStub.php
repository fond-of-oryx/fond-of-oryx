<?php

namespace FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Zed;

use FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;

class CompanyBusinessUnitAddressSearchRestApiStub implements CompanyBusinessUnitAddressSearchRestApiStubInterface
{
    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\Dependency\Client\CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CompanyBusinessUnitAddressSearchRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer
     */
    public function searchCompanyBusinessUnitAddress(
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): CompanyBusinessUnitAddressListTransfer {
        /** @var \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer */
        $companyBusinessUnitAddressListTransfer = $this->zedRequestClient->call(
            '/company-business-unit-address-search-rest-api/gateway/search-company-business-unit-address',
            $companyBusinessUnitAddressListTransfer,
        );

        return $companyBusinessUnitAddressListTransfer;
    }
}
