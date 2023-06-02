<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Zed;

use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer;

class RepresentativeCompanyUserTradeFairRestApiPermissionStub implements RepresentativeCompanyUserTradeFairRestApiPermissionStubInterface
{
    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Dependency\Client\RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface $zedRequestClient
     */
    public function __construct(RepresentativeCompanyUserTradeFairRestApiPermissionToZedRequestInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $tradeFairRepresentationPermissionRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function hasPermissionToManageOwnTradeFairRepresentations(
        RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $tradeFairRepresentationPermissionRequestTransfer
    ) {
        return $this->zedRequestClient->call(
            '/representative-company-user-trade-fair-rest-api-permission/gateway/has-permission-to-manage-trade-fair-representations',
            $tradeFairRepresentationPermissionRequestTransfer,
        );
    }
}
