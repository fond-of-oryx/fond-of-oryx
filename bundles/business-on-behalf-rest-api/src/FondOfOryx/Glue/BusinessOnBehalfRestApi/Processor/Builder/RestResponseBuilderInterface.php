<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildEmptyRestResponse(): RestResponseInterface;

    /**
     * @param array<\Generated\Shared\Transfer\RestBusinessOnBehalfErrorTransfer> $restBusinessOnBehalfErrorTransfers
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildErrorRestResponse(array $restBusinessOnBehalfErrorTransfers): RestResponseInterface;
}
