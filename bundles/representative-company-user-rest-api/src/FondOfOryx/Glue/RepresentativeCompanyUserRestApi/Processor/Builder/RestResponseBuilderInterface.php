<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder;

use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representationOfSalesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserRestResponse(
        RepresentativeCompanyUserTransfer $representationOfSalesTransfer
    ): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserMissingPermissionResponse(): RestResponseInterface;
}
