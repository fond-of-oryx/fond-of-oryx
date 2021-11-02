<?php

namespace FondOfOryx\Client\CompanyUserSearchRestApi\Zed;

use FondOfOryx\Client\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyUserListTransfer;

class CompanyUserSearchRestApiStub implements CompanyUserSearchRestApiStubInterface
{
    /**
     * @var \FondOfOryx\Client\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\CompanyUserSearchRestApi\Dependency\Client\CompanyUserSearchRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CompanyUserSearchRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserListTransfer
     */
    public function searchCompanyUser(CompanyUserListTransfer $companyUserListTransfer): CompanyUserListTransfer
    {
        /** @var \Generated\Shared\Transfer\CompanyUserListTransfer $companyUserListTransfer */
        $companyUserListTransfer = $this->zedRequestClient->call(
            '/company-user-search-rest-api/gateway/search-company-user',
            $companyUserListTransfer,
        );

        return $companyUserListTransfer;
    }
}
