<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission;

use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;

interface PermissionCheckerInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer $attributesTransfer
     *
     * @return bool
     */
    public function can(RestRepresentativeCompanyUserAttributesTransfer $attributesTransfer): bool;
}
