<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder;

use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserRestResponse(
        RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
    ): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer $representativeCompanyUserTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserCollectionRestResponse(
        RepresentativeCompanyUserCollectionTransfer $representativeCompanyUserTransfer
    ): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserMissingPermissionResponse(): RestResponseInterface;
}
