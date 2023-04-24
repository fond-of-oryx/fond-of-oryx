<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer;
use Generated\Shared\Transfer\RestRepresentationOfSalesAttributesTransfer;

interface PermissionRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentationOfSalesAttributesTransfer $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentationOfSalesPermissionRequestTransfer
     */
    public function fromAttributesTransfer(RestRepresentationOfSalesAttributesTransfer $attributesTransfer): RepresentationOfSalesPermissionRequestTransfer;
}
