<?php

namespace FondOfOryx\Glue\PayoneRestApi\Processor\Builder;

use FondOfOryx\Glue\PayoneRestApi\PayoneRestApiConfig;
use FondOfOryx\Glue\PayoneRestApi\Processor\Mapper\RestCreditCardDataResponseAttributesMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use SprykerEco\Client\Payone\ClientApi\Request\CreditCardCheckContainer;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfOryx\Glue\PayoneRestApi\Processor\Mapper\RestCreditCardDataResponseAttributesMapperInterface
     */
    protected $creditCardDataResponseAttributesMapper;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfOryx\Glue\PayoneRestApi\Processor\Mapper\RestCreditCardDataResponseAttributesMapperInterface $creditCardDataResponseAttributesMapper
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        RestCreditCardDataResponseAttributesMapperInterface $creditCardDataResponseAttributesMapper
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->creditCardDataResponseAttributesMapper = $creditCardDataResponseAttributesMapper;
    }

    /**
     * @param \SprykerEco\Client\Payone\ClientApi\Request\CreditCardCheckContainer $creditCardCheckContainer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildCreditCardDataCheckRestResponse(
        CreditCardCheckContainer $creditCardCheckContainer,
        RestRequestInterface $restRequest
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $restResource = $this->restResourceBuilder->createRestResource(
            PayoneRestApiConfig::RESOURCE_PAYONE_CREDIT_CARD_CHECK,
            null,
            $this->creditCardDataResponseAttributesMapper->mapCreditCardDataContainerToResponseAttributesTransfer($creditCardCheckContainer),
        );

        return $restResponse->addResource($restResource);
    }
}
