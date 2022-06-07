<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Reader;

use FondOfOryx\Client\CartSearchRestApi\CartSearchRestApiClientInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\QuoteListMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CartReader implements CartReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    private $customerReferenceFilter;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\QuoteListMapperInterface
     */
    protected $quoteListMapper;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\CartSearchRestApi\CartSearchRestApiClientInterface
     */
    protected $client;

    /**
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface $customerReferenceFilter
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\QuoteListMapperInterface $quoteListMapper
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\CartSearchRestApi\CartSearchRestApiClientInterface $client
     */
    public function __construct(
        CustomerReferenceFilterInterface $customerReferenceFilter,
        QuoteListMapperInterface $quoteListMapper,
        RestResponseBuilderInterface $restResponseBuilder,
        CartSearchRestApiClientInterface $client
    ) {
        $this->customerReferenceFilter = $customerReferenceFilter;
        $this->quoteListMapper = $quoteListMapper;
        $this->restResponseBuilder = $restResponseBuilder;
        $this->client = $client;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function find(RestRequestInterface $restRequest): RestResponseInterface
    {
        $customerReference = $this->customerReferenceFilter->filterFromRestRequest($restRequest);

        if ($customerReference === null) {
            return $this->restResponseBuilder->buildUseIsNotSpecifiedRestResponse();
        }

        $quoteListTransfer = $this->quoteListMapper->fromRestRequest($restRequest);

        return $this->restResponseBuilder->buildCartSearchRestResponse(
            $this->client->findQuotes($quoteListTransfer),
            $restRequest->getMetadata()->getLocale(),
        );
    }
}
