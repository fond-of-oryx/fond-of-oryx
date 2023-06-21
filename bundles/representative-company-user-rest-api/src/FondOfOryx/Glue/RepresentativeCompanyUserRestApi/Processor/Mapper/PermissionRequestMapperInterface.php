<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer;

interface PermissionRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserAttributesTransfer $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserRestApiPermissionRequestTransfer
     */
    public function fromAttributesTransfer(
        RestRepresentativeCompanyUserAttributesTransfer $attributesTransfer
    ): RepresentativeCompanyUserRestApiPermissionRequestTransfer;
}
