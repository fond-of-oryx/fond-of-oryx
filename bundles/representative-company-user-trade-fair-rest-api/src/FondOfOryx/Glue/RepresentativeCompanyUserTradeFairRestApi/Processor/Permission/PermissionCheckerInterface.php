<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Permission;

use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;

interface PermissionCheckerInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer $attributesTransfer
     *
     * @return bool
     */
    public function can(RestRepresentativeCompanyUserTradeFairAttributesTransfer $attributesTransfer): bool;
}
