<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder;

use ArrayObject;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface SplittableCheckoutRestResponseBuilderInterface
{
    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer> $restSplittableCheckoutErrorTransfers
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createNotPlacedErrorRestResponse(
        ArrayObject $restSplittableCheckoutErrorTransfers,
        RestRequestInterface $restRequest
    ): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\SplittableCheckoutTransfer $splittableCheckoutTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createRestResponse(
        SplittableCheckoutTransfer $splittableCheckoutTransfer
    ): RestResponseInterface;
}
