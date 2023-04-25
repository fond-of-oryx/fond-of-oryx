<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client;

use Generated\Shared\Transfer\RepresentativeCompanyUserPermissionRequestTransfer;

interface RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentativeCompanyUserPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentativeCompanyUserPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool;
}
