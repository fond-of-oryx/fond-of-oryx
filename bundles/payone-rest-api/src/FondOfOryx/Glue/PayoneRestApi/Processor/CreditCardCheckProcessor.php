<?php

namespace FondOfOryx\Glue\PayoneRestApi\Processor;

use FondOfOryx\Glue\PayoneRestApi\Dependency\PayoneRestApiToPayoneClientInterface;
use FondOfOryx\Glue\PayoneRestApi\Processor\Builder\RestResponseBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CreditCardCheckProcessor implements CreditCardCheckProcessorInterface
{
    /**
     * @var \FondOfOryx\Glue\PayoneRestApi\Dependency\PayoneRestApiToPayoneClientInterface
     */
    protected $payoneClient;

    /**
     * @var \FondOfOryx\Glue\PayoneRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $responseBuilder;

    /**
     * @param \FondOfOryx\Glue\PayoneRestApi\Dependency\PayoneRestApiToPayoneClientInterface $payoneClient
     * @param \FondOfOryx\Glue\PayoneRestApi\Processor\Builder\RestResponseBuilderInterface $responseBuilder
     */
    public function __construct(PayoneRestApiToPayoneClientInterface $payoneClient, RestResponseBuilderInterface $responseBuilder)
    {
        $this->payoneClient = $payoneClient;
        $this->responseBuilder = $responseBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getCheckCreditCardData(
        RestRequestInterface $restRequest
    ): RestResponseInterface
    {
        return $this->responseBuilder->buildCreditCardDataCheckRestResponse($this->payoneClient->getCreditCardCheckRequest(), $restRequest);
    }
}
