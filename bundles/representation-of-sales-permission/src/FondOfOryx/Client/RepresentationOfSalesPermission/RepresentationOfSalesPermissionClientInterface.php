<?php

namespace FondOfOryx\Client\RepresentationOfSalesPermission;

use Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer;

interface RepresentationOfSalesPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool;

    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool;
}
