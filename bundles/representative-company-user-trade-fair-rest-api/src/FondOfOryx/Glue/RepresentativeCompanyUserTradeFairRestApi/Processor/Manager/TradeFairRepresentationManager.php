<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Manager;

use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiClientInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Zed\Api\ApiConfig;

class TradeFairRepresentationManager implements TradeFairRepresentationManagerInterface
{
    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiClientInterface
     */
    protected $client;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface
     */
    protected $representationMapper;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected $responseBuilder;

    /**
     * @param \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiClientInterface $client
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface $representationMapper
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface $responseBuilder
     */
    public function __construct(
        RepresentativeCompanyUserTradeFairRestApiClientInterface $client,
        RepresentationMapperInterface $representationMapper,
        RestResponseBuilderInterface $responseBuilder
    ) {
        $this->client = $client;
        $this->representationMapper = $representationMapper;
        $this->responseBuilder = $responseBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function add(RestRequestInterface $restRequest): RestResponseInterface
    {
        $attributes = $this->representationMapper->createAttributesFromRequest($restRequest);
        $representationRestRequestTransfer = $this->representationMapper->createRequest($restRequest, $attributes);
        $representationRestResponseTransfer = $this->client->addTradeFairRepresentation($representationRestRequestTransfer);

        if ($representationRestResponseTransfer->getError() !== null) {
            return $this->responseBuilder
                ->createRestErrorResponse($representationRestResponseTransfer->getError(), ApiConfig::HTTP_CODE_VALIDATION_ERRORS);
        }

        return $this->responseBuilder
            ->buildRepresentativeCompanyUserTradeFairRestResponse($representationRestResponseTransfer->getRepresentation());
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function get(RestRequestInterface $restRequest): RestResponseInterface
    {
        $attributes = $this->representationMapper->createAttributesFromRequest($restRequest);

        $representationRestRequestTransfer = $this->representationMapper->createRequest($restRequest, $attributes);
        $representationRestResponseTransfer = $this->client->getTradeFairRepresentation($representationRestRequestTransfer);

        if ($representationRestResponseTransfer->getError() !== null) {
            return $this->responseBuilder
                ->createRestErrorResponse($representationRestResponseTransfer->getError(), ApiConfig::HTTP_CODE_VALIDATION_ERRORS);
        }

        return $this->responseBuilder->buildRepresentativeCompanyUserTradeFairCollectionRestResponse($representationRestResponseTransfer->getCollection());
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function patch(RestRequestInterface $restRequest): RestResponseInterface
    {
        $attributes = $this->representationMapper->createAttributesFromRequest($restRequest);

        $representationRestRequestTransfer = $this->representationMapper->createRequest($restRequest, $attributes);
        $representationRestResponseTransfer = $this->client->patchTradeFairRepresentation($representationRestRequestTransfer);

        if ($representationRestResponseTransfer->getError() !== null) {
            return $this->responseBuilder
                ->createRestErrorResponse($representationRestResponseTransfer->getError(), ApiConfig::HTTP_CODE_VALIDATION_ERRORS);
        }

        return $this->responseBuilder->buildRepresentativeCompanyUserTradeFairRestResponse($representationRestResponseTransfer->getRepresentation());
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function delete(RestRequestInterface $restRequest): RestResponseInterface
    {
        $attributes = $this->representationMapper->createAttributesFromRequest($restRequest);

        $representationRestRequestTransfer = $this->representationMapper->createRequest($restRequest, $attributes);
        $representationRestResponseTransfer = $this->client->deleteTradeFairRepresentation($representationRestRequestTransfer);

        if ($representationRestResponseTransfer->getError() !== null) {
            return $this->responseBuilder
                ->createRestErrorResponse($representationRestResponseTransfer->getError(), ApiConfig::HTTP_CODE_VALIDATION_ERRORS);
        }

        return $this->responseBuilder->buildRepresentativeCompanyUserTradeFairRestResponse($representationRestResponseTransfer->getRepresentation());
    }
}
