<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder;

use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer $restRepresentativeCompanyUserResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserRestResponse(
        RestRepresentativeCompanyUserResponseTransfer $restRepresentativeCompanyUserResponseTransfer
    ): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserMissingPermissionResponse(): RestResponseInterface;
}
