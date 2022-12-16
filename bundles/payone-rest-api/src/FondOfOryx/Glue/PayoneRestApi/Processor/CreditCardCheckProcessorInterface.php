<?php

namespace FondOfOryx\Glue\PayoneRestApi\Processor;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface CreditCardCheckProcessorInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getCheckCreditCardData(
        RestRequestInterface $restRequest
    ): RestResponseInterface;
}
