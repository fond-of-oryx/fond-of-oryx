<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Builder;

use Generated\Shared\Transfer\SplittableTotalsTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface SplittableTotalsRestResponseBuilderInterface
{
    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createNotFoundErrorRestResponse(): RestResponseInterface;

    /**
     * @param \Generated\Shared\Transfer\SplittableTotalsTransfer $splittableTotalsTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createRestResponse(
        SplittableTotalsTransfer $splittableTotalsTransfer
    ): RestResponseInterface;
}
