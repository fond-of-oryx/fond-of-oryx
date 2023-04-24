<?php

namespace FondOfOryx\Glue\RepresentationOfSalesRestApi\Dependency\Client;

use Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer;

interface RepresentationOfSalesRestApiToRepresentationOfSalesPermissionInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool;

    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentationOfSalesPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool;
}
