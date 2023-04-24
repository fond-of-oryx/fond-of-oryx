<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Zed;

use FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Dependency\Client\RepresentativeCompanyUserRestApiPermissionToZedRequestInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;

class RepresentativeCompanyUserRestApiPermissionStub implements RepresentativeCompanyUserRestApiPermissionStubInterface
{
    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Dependency\Client\RepresentativeCompanyUserRestApiPermissionToZedRequestInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Dependency\Client\RepresentativeCompanyUserRestApiPermissionToZedRequestInterface $zedRequestClient
     */
    public function __construct(RepresentativeCompanyUserRestApiPermissionToZedRequestInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ) {
        return $this->zedRequestClient->call(
            '/representative-company-user-rest-api-permission/gateway/has-permission-to-manage-own-representations',
            $representationOfSalesPermissionRequestTransfer,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ) {
        return $this->zedRequestClient->call(
            '/representative-company-user-rest-api-permission/gateway/has-permission-to-manage-global-representations',
            $representationOfSalesPermissionRequestTransfer,
        );
    }
}
