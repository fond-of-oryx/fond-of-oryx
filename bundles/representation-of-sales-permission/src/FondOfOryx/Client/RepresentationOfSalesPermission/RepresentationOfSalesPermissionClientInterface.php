<?php

namespace FondOfOryx\Client\RepresentationOfSalesPermission;

use Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer;

interface RepresentationOfSalesPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return bool
     * @throws \Exception
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool;

    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return bool
     * @throws \Exception
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool;
}
