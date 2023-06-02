<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Manager;

use FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiClientInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Permission\PermissionCheckerInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

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
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Permission\PermissionCheckerInterface
     */
    protected $permissionChecker;

    /**
     * @param \FondOfOryx\Client\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiClientInterface $client
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Mapper\RepresentationMapperInterface $representationMapper
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder\RestResponseBuilderInterface $responseBuilder
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Permission\PermissionCheckerInterface $permissionChecker
     */
    public function __construct(
        RepresentativeCompanyUserTradeFairRestApiClientInterface $client,
        RepresentationMapperInterface $representationMapper,
        RestResponseBuilderInterface $responseBuilder,
        PermissionCheckerInterface $permissionChecker
    ) {
        $this->client = $client;
        $this->representationMapper = $representationMapper;
        $this->responseBuilder = $responseBuilder;
        $this->permissionChecker = $permissionChecker;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function add(RestRequestInterface $restRequest): RestResponseInterface
    {
        $attributes = $this->representationMapper->createAttributesFromRequest($restRequest);

        if ($this->permissionChecker->can($attributes)) {
            $representationRestRequestTransfer = $this->representationMapper->createRequest($restRequest, $attributes);
            $representationRestResponseTransfer = $this->client->addTradeFairRepresentation($representationRestRequestTransfer);

            return $this->responseBuilder->buildRepresentativeCompanyUserTradeFairRestResponse($representationRestResponseTransfer->getRepresentation());
        }

        return $this->responseBuilder->buildRepresentativeCompanyUserTradeFairMissingPermissionResponse();
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function get(RestRequestInterface $restRequest): RestResponseInterface
    {
        $attributes = $this->representationMapper->createAttributesFromRequest($restRequest);

        if ($this->permissionChecker->can($attributes)) {
            $representationRestRequestTransfer = $this->representationMapper->createRequest($restRequest, $attributes);
            $representationRestResponseTransfer = $this->client->getTradeFairRepresentation($representationRestRequestTransfer);

            return $this->responseBuilder->buildRepresentativeCompanyUserTradeFairCollectionRestResponse($representationRestResponseTransfer->getCollection());
        }

        return $this->responseBuilder->buildRepresentativeCompanyUserTradeFairMissingPermissionResponse();
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function patch(RestRequestInterface $restRequest): RestResponseInterface
    {
        $attributes = $this->representationMapper->createAttributesFromRequest($restRequest);

        if ($this->permissionChecker->can($attributes)) {
            $representationRestRequestTransfer = $this->representationMapper->createRequest($restRequest, $attributes);
            $representationRestResponseTransfer = $this->client->patchTradeFairRepresentation($representationRestRequestTransfer);

            return $this->responseBuilder->buildRepresentativeCompanyUserTradeFairRestResponse($representationRestResponseTransfer->getRepresentation());
        }

        return $this->responseBuilder->buildRepresentativeCompanyUserTradeFairMissingPermissionResponse();
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function delete(RestRequestInterface $restRequest): RestResponseInterface
    {
        $attributes = $this->representationMapper->createAttributesFromRequest($restRequest);

        if ($this->permissionChecker->can($attributes)) {
            $representationRestRequestTransfer = $this->representationMapper->createRequest($restRequest, $attributes);
            $representationRestResponseTransfer = $this->client->deleteTradeFairRepresentation($representationRestRequestTransfer);

            return $this->responseBuilder->buildRepresentativeCompanyUserTradeFairRestResponse($representationRestResponseTransfer->getRepresentation());
        }

        return $this->responseBuilder->buildRepresentativeCompanyUserTradeFairMissingPermissionResponse();
    }
}
