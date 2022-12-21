<?php

namespace FondOfOryx\Glue\PayoneRestApi\Processor\Builder;

use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use SprykerEco\Client\Payone\ClientApi\Request\CreditCardCheckContainer;

interface RestResponseBuilderInterface
{
    /**
     * @param \SprykerEco\Client\Payone\ClientApi\Request\CreditCardCheckContainer $creditCardCheckContainer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCreditCardDataCheckRestResponse(
        CreditCardCheckContainer $creditCardCheckContainer,
        RestRequestInterface $restRequest
    ): RestResponseInterface;
}
