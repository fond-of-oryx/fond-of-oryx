<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client;

use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;

interface RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representationOfSalesPermissionRequestTransfer
    ): bool;
}
