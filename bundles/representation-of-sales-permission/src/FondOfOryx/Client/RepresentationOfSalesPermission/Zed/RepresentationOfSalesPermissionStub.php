<?php

namespace FondOfOryx\Client\RepresentationOfSalesPermission\Zed;

use FondOfOryx\Client\RepresentationOfSalesPermission\Dependency\Client\RepresentationOfSalesPermissionToZedRequestInterface;
use Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer;

class RepresentationOfSalesPermissionStub implements RepresentationOfSalesPermissionStubInterface
{
    /**
     * @var \FondOfOryx\Client\RepresentationOfSalesPermission\Dependency\Client\RepresentationOfSalesPermissionToZedRequestInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\RepresentationOfSalesPermission\Dependency\Client\RepresentationOfSalesPermissionToZedRequestInterface $zedRequestClient
     */
    public function __construct(RepresentationOfSalesPermissionToZedRequestInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ) {
        return $this->zedRequestClient->call(
            '/representation-of-sales-permission/gateway/has-permission-to-manage-own-representations',
            $representationOfSalesPermissionRequestTransfer,
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ) {
        return $this->zedRequestClient->call(
            '/representation-of-sales-permission/gateway/has-permission-to-manage-global-representations',
            $representationOfSalesPermissionRequestTransfer,
        );
    }
}
