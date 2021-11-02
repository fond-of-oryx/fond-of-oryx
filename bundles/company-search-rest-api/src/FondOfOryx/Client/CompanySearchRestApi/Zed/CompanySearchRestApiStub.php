<?php

namespace FondOfOryx\Client\CompanySearchRestApi\Zed;

use FondOfOryx\Client\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyListTransfer;

class CompanySearchRestApiStub implements CompanySearchRestApiStubInterface
{
    /**
     * @var \FondOfOryx\Client\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\CompanySearchRestApi\Dependency\Client\CompanySearchRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CompanySearchRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyListTransfer
     */
    public function searchCompanies(CompanyListTransfer $companyListTransfer): CompanyListTransfer
    {
        /** @var \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer */
        $companyListTransfer = $this->zedRequestClient->call(
            '/company-search-rest-api/gateway/search-companies',
            $companyListTransfer,
        );

        return $companyListTransfer;
    }
}
