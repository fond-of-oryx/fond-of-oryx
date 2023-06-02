<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;

interface PermissionRequestMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer
     */
    public function fromAttributesTransfer(
        RestRepresentativeCompanyUserTradeFairAttributesTransfer $attributesTransfer
    ): RepresentativeCompanyUserTradeFairRestApiPermissionRequestTransfer;
}
