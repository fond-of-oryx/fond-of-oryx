<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Dependency\Client;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer;

interface RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairRestApiPermissionInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $representativeCompanyUserTradeFairPermissionRequestTransfer
     *
     * @return bool
     */
    public function hasPermissionToManageOwnTradeFairRepresentations(
        RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $representativeCompanyUserTradeFairPermissionRequestTransfer
    ): bool;
}
