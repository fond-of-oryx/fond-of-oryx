<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder;

use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserTradeFairRestResponse(
        RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $restResource = $this->restResourceBuilder->createRestResource(
            RepresentativeCompanyUserTradeFairRestApiConfig::RESOURCE_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API,
            null,
            $representativeCompanyUserTradeFairTransfer,
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserTradeFairCollectionRestResponse(
        RepresentativeCompanyUserTradeFairCollectionTransfer $representativeCompanyUserTradeFairTransfer
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $restResource = $this->restResourceBuilder->createRestResource(
            RepresentativeCompanyUserTradeFairRestApiConfig::RESOURCE_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API,
            null,
            $representativeCompanyUserTradeFairTransfer,
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserTradeFairMissingPermissionResponse(): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode((string)RepresentativeCompanyUserTradeFairRestApiConfig::RESPONSE_CODE_USER_IS_NOT_ALLOWED_TO_ADD_TRADE_FAIR_REPRESENTATION)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(RepresentativeCompanyUserTradeFairRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_ALLOWED_TO_ADD_TRADE_FAIR_REPRESENTATION);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
