<?php

namespace FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApiPermission;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer;

interface RepresentativeCompanyUserTradeFairRestApiPermissionClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $tradeFairRepresentationPermissionRequestTransfer
     *
     * @throws \Exception
     *
     * @return bool
     */
    public function hasPermissionToManageOwnTradeFairRepresentations(
        RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer $tradeFairRepresentationPermissionRequestTransfer
    ): bool;
}
