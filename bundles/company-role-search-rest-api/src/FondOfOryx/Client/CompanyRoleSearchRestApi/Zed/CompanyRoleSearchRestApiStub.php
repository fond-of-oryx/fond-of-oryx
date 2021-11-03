<?php

namespace FondOfOryx\Client\CompanyRoleSearchRestApi\Zed;

use FondOfOryx\Client\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyRoleListTransfer;

class CompanyRoleSearchRestApiStub implements CompanyRoleSearchRestApiStubInterface
{
    /**
     * @var \FondOfOryx\Client\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CompanyRoleSearchRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyRoleListTransfer
     */
    public function searchCompanyRoles(CompanyRoleListTransfer $companyRoleListTransfer): CompanyRoleListTransfer
    {
        /** @var \Generated\Shared\Transfer\CompanyRoleListTransfer $companyRoleListTransfer */
        $companyRoleListTransfer = $this->zedRequestClient->call(
            '/company-role-search-rest-api/gateway/search-company-roles',
            $companyRoleListTransfer,
        );

        return $companyRoleListTransfer;
    }
}
