<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Reader;

use FondOfOryx\Client\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiClientInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\OrderBudgetListMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class OrderBudgetReader implements OrderBudgetReaderInterface
{
    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface
     */
    protected CustomerReferenceFilterInterface $customerReferenceFilter;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\OrderBudgetListMapperInterface
     */
    protected OrderBudgetListMapperInterface $orderBudgetListMapper;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected RestResponseBuilderInterface $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiClientInterface
     */
    protected OrderBudgetSearchRestApiClientInterface $client;

    /**
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface $customerReferenceFilter
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\OrderBudgetListMapperInterface $orderBudgetListMapper
     * @param \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiClientInterface $client
     */
    public function __construct(
        CustomerReferenceFilterInterface $customerReferenceFilter,
        OrderBudgetListMapperInterface $orderBudgetListMapper,
        RestResponseBuilderInterface $restResponseBuilder,
        OrderBudgetSearchRestApiClientInterface $client
    ) {
        $this->customerReferenceFilter = $customerReferenceFilter;
        $this->orderBudgetListMapper = $orderBudgetListMapper;
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

        $orderBudgetListTransfer = $this->orderBudgetListMapper->fromRestRequest($restRequest);

        return $this->restResponseBuilder->buildOrderBudgetSearchRestResponse(
            $this->client->findOrderBudgets($orderBudgetListTransfer),
            $restRequest->getMetadata()->getLocale(),
        );
    }
}
