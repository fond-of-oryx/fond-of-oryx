<?php

namespace FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Zed;

use FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;

class CompanyBusinessUnitSearchRestApiStub implements CompanyBusinessUnitSearchRestApiStubInterface
{
    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CompanyBusinessUnitSearchRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer
     */
    public function searchCompanyBusinessUnit(CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer): CompanyBusinessUnitListTransfer
    {
        /** @var \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer */
        $companyBusinessUnitListTransfer = $this->zedRequestClient->call(
            '/company-business-unit-search-rest-api/gateway/search-company-business-unit',
            $companyBusinessUnitListTransfer
        );

        return $companyBusinessUnitListTransfer;
    }
}
