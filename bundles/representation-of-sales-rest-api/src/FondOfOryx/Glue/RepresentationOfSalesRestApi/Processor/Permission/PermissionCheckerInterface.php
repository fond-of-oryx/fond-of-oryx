<?php

namespace FondOfOryx\Glue\RepresentationOfSalesRestApi\Processor\Permission;

use Generated\Shared\Transfer\RestRepresentationOfSalesAttributesTransfer;

interface PermissionCheckerInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentationOfSalesAttributesTransfer $attributesTransfer
     *
     * @return bool
     */
    public function can(RestRepresentationOfSalesAttributesTransfer $attributesTransfer): bool;
}
