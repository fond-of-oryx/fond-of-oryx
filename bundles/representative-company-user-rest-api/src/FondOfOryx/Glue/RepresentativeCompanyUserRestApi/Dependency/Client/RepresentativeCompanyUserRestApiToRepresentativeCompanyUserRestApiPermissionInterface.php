<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Dependency\Client;

use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;

interface RepresentativeCompanyUserRestApiToRepresentativeCompanyUserRestApiPermissionInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representativeCompanyUserPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageGlobalRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representativeCompanyUserPermissionRequestTransfer
    ): bool;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer $representativeCompanyUserPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageOwnRepresentations(
        RepresentativeCompanyUserRestApiPermissionRequestTransfer $representativeCompanyUserPermissionRequestTransfer
    ): bool;
}
