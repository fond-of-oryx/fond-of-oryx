<?php

namespace FondOfOryx\Client\RepresentationOfSalesPermission\Zed;

use Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer;

interface RepresentationOfSalesPermissionStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    );

    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    );
}
