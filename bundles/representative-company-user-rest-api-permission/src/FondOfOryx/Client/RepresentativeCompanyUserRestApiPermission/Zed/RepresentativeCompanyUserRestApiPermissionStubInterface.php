<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserRestApiPermission\Zed;

use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;

interface RepresentativeCompanyUserRestApiPermissionStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    );

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    );
}
