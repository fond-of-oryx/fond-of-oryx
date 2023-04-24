<?php

namespace FondOfOryx\Glue\RepresentationOfSalesRestApi\Processor\Builder;

use Generated\Shared\Transfer\RepresentationOfSalesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesTransfer $representationOfSalesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentationOfSalesRestResponse(
        RepresentationOfSalesTransfer $representationOfSalesTransfer
    ): RestResponseInterface;

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentationOfSalesMissingPermissionResponse(): RestResponseInterface;
}
