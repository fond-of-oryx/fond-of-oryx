<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder;

use ArrayObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildEmptyRestResponse(): RestResponseInterface;

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\RestBusinessOnBehalfErrorTransfer> $restBusinessOnBehalfErrorTransfers
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildErrorRestResponse(ArrayObject $restBusinessOnBehalfErrorTransfers): RestResponseInterface;
}
