<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder;

use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer;
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
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer $restRepresentativeCompanyUserCollectionResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserCollectionRestResponse(
        RestRepresentativeCompanyUserCollectionResponseTransfer $restRepresentativeCompanyUserCollectionResponseTransfer
    ): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\RestErrorMessageTransfer|null $restErrorMessageTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildErrorResponse(?RestErrorMessageTransfer $restErrorMessageTransfer = null): RestResponseInterface;
}
