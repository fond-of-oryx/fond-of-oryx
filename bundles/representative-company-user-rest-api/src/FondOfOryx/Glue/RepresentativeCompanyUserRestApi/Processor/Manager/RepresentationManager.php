<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Manager;

use FondOfOryx\Client\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiClientInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\RepresentationMapperInterface;
use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission\PermissionCheckerInterface;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RepresentationManager implements RepresentationManagerInterface
{
    /**
     * @var \FondOfOryx\Client\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiClientInterface
     */
    protected RepresentativeCompanyUserRestApiClientInterface $client;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\RepresentationMapperInterface
     */
    protected RepresentationMapperInterface $representationMapper;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected RestResponseBuilderInterface $responseBuilder;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission\PermissionCheckerInterface
     */
    protected PermissionCheckerInterface $permissionChecker;

    /**
     * @param \FondOfOryx\Client\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiClientInterface $client
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Mapper\RepresentationMapperInterface $representationMapper
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder\RestResponseBuilderInterface $responseBuilder
     * @param \FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Permission\PermissionCheckerInterface $permissionChecker
     */
    public function __construct(
        RepresentativeCompanyUserRestApiClientInterface $client,
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

        $representationRestRequestTransfer = $this->representationMapper->createRequest($restRequest, $attributes);
        $representationRestResponseTransfer = $this->client->addRepresentation($representationRestRequestTransfer);

        if ($representationRestResponseTransfer instanceof RestErrorMessageTransfer) {
            return $this->responseBuilder->buildErrorResponse($representationRestResponseTransfer);
        }

        return $this->responseBuilder->buildRepresentativeCompanyUserRestResponse($representationRestResponseTransfer);
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
        $representationRestResponseTransfer = $this->client->getRepresentation($representationRestRequestTransfer);

        if ($representationRestResponseTransfer instanceof RestErrorMessageTransfer) {
            return $this->responseBuilder->buildErrorResponse($representationRestResponseTransfer);
        }

        return $this->responseBuilder->buildRepresentativeCompanyUserCollectionRestResponse($representationRestResponseTransfer);
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
        $representationRestResponseTransfer = $this->client->patchRepresentation($representationRestRequestTransfer);

        if ($representationRestResponseTransfer instanceof RestErrorMessageTransfer) {
            return $this->responseBuilder->buildErrorResponse($representationRestResponseTransfer);
        }

        return $this->responseBuilder->buildRepresentativeCompanyUserRestResponse($representationRestResponseTransfer);
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
        $representationRestResponseTransfer = $this->client->deleteRepresentation($representationRestRequestTransfer);

        if ($representationRestResponseTransfer instanceof RestErrorMessageTransfer) {
            return $this->responseBuilder->buildErrorResponse($representationRestResponseTransfer);
        }

        return $this->responseBuilder->buildRepresentativeCompanyUserRestResponse($representationRestResponseTransfer);
    }
}
