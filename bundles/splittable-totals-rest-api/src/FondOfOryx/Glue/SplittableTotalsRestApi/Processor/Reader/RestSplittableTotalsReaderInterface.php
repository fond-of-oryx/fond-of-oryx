<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Reader;

use Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface RestSplittableTotalsReaderInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function get(
        RestRequestInterface $restRequest,
        RestSplittableTotalsRequestAttributesTransfer $restCheckoutRequestAttributesTransfer
    ): RestResponseInterface;
}
