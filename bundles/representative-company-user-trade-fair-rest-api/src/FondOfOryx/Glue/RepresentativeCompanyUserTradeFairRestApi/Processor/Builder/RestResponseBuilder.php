<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Processor\Builder;

use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

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
     * @param string $error
     * @param int $code
     * @param int $status
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function createRestErrorResponse(string $error, int $code, int $status = 0): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode((string)$code)
            ->setStatus(0)
            ->setDetail($error);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
