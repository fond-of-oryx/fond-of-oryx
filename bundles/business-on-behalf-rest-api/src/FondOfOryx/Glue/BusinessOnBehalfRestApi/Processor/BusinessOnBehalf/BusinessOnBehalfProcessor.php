<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\BusinessOnBehalf;

use FondOfOryx\Client\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiClientInterface;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Filter\IdCustomerFilterInterface;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Mapper\RestBusinessOnBehalfRequestMapperInterface;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class BusinessOnBehalfProcessor implements BusinessOnBehalfProcessorInterface
{
    /**
     * @var \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Filter\IdCustomerFilterInterface
     */
    protected IdCustomerFilterInterface $idCustomerFilter;

    /**
     * @var \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Mapper\RestBusinessOnBehalfRequestMapperInterface
     */
    protected RestBusinessOnBehalfRequestMapperInterface $restBusinessOnBehalfRequestMapper;

    /**
     * @var \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected RestResponseBuilderInterface $restResponseBuilder;

    /**
     * @var \FondOfOryx\Client\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiClientInterface
     */
    protected BusinessOnBehalfRestApiClientInterface $client;

    /**
     * @param \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Filter\IdCustomerFilterInterface $idCustomerFilter
     * @param \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Mapper\RestBusinessOnBehalfRequestMapperInterface $restBusinessOnBehalfRequestMapper
     * @param \FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiClientInterface $client
     */
    public function __construct(
        IdCustomerFilterInterface $idCustomerFilter,
        RestBusinessOnBehalfRequestMapperInterface $restBusinessOnBehalfRequestMapper,
        RestResponseBuilderInterface $restResponseBuilder,
        BusinessOnBehalfRestApiClientInterface $client
    ) {
        $this->idCustomerFilter = $idCustomerFilter;
        $this->restBusinessOnBehalfRequestMapper = $restBusinessOnBehalfRequestMapper;
        $this->restResponseBuilder = $restResponseBuilder;
        $this->client = $client;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function setDefaultCompanyUser(
        RestRequestInterface $restRequest,
        RestBusinessOnBehalfRequestAttributesTransfer $restBusinessOnBehalfRequestAttributesTransfer
    ): RestResponseInterface {
        $restBusinessOnBehalfRequestTransfer = $this->restBusinessOnBehalfRequestMapper
            ->fromRestBusinessOnBehalfRequestAttributes($restBusinessOnBehalfRequestAttributesTransfer)
            ->setIdCustomer($this->idCustomerFilter->filterFromRestRequest($restRequest));

        $restBusinessOnBehalfResponseTransfer = $this->client->setDefaultCompanyUserByRestBusinessOnBehalfRequest(
            $restBusinessOnBehalfRequestTransfer,
        );

        if ($restBusinessOnBehalfResponseTransfer->getIsSuccessful()) {
            return $this->restResponseBuilder->buildEmptyRestResponse();
        }

        return $this->restResponseBuilder->buildErrorRestResponse($restBusinessOnBehalfResponseTransfer->getErrors());
    }
}
