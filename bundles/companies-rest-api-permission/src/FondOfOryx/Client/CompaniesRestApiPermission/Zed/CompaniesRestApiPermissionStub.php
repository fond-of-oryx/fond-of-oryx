<?php

namespace FondOfOryx\Client\CompaniesRestApiPermission\Zed;

use FondOfOryx\Client\CompaniesRestApiPermission\Dependency\Client\CompaniesRestApiPermissionToZedRequestInterface;
use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;

class CompaniesRestApiPermissionStub implements CompaniesRestApiPermissionStubInterface
{
    /**
     * @var \FondOfOryx\Client\CompaniesRestApiPermission\Dependency\Client\CompaniesRestApiPermissionToZedRequestInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\CompaniesRestApiPermission\Dependency\Client\CompaniesRestApiPermissionToZedRequestInterface $zedRequestClient
     */
    public function __construct(CompaniesRestApiPermissionToZedRequestInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompaniesRestApiPermissionResponseTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function hasPermissionToDeleteCompany(
        CompaniesRestApiPermissionRequestTransfer $companiesRestApiPermissionRequestTransfer
    ) {
        return $this->zedRequestClient->call(
            '/companies-rest-api-permission/gateway/has-permission-to-delete-company',
            $companiesRestApiPermissionRequestTransfer,
        );
    }
}
