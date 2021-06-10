<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder;

use Generated\Shared\Transfer\SplittableCheckoutTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createNotPlacedErrorRestResponse(): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\SplittableCheckoutTransfer $splittableCheckoutTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createRestResponse(
        SplittableCheckoutTransfer $splittableCheckoutTransfer
    ): RestResponseInterface;
}
