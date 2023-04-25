<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RepresentativeCompanyUserPermissionRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;

interface PermissionRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserPermissionRequestTransfer
     */
    public function fromAttributesTransfer(
        RestRepresentativeCompanyUserAttributesTransfer $attributesTransfer
    ): RepresentativeCompanyUserPermissionRequestTransfer;
}
