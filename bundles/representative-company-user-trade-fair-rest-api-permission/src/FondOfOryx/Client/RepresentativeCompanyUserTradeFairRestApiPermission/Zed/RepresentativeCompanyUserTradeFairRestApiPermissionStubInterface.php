<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission\Zed;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer;

interface RepresentativeCompanyUserTradeFairRestApiPermissionStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $tradeFairRepresentationPermissionRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function hasPermissionToManageOwnTradeFairRepresentations(
        RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $tradeFairRepresentationPermissionRequestTransfer
    );
}
