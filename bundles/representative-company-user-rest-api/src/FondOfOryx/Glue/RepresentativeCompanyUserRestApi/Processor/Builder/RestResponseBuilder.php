<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserRestApi\Processor\Builder;

use FondOfOryx\Glue\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiConfig;
use FondOfOryx\Shared\RepresentativeCompanyUserRestApi\RepresentativeCompanyUserRestApiConstants;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer;
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
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer $restRepresentativeCompanyUserResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserRestResponse(
        RestRepresentativeCompanyUserResponseTransfer $restRepresentativeCompanyUserResponseTransfer
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $restResource = $this->restResourceBuilder->createRestResource(
            RepresentativeCompanyUserRestApiConfig::RESOURCE_REPRESENTATIVE_COMPANY_USER_REST_API,
            $this->getUuidFromRestRepresentativeCompanyUserResponse($restRepresentativeCompanyUserResponseTransfer),
            $restRepresentativeCompanyUserResponseTransfer,
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserCollectionResponseTransfer $restRepresentativeCompanyUserCollectionResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRepresentativeCompanyUserCollectionRestResponse(
        RestRepresentativeCompanyUserCollectionResponseTransfer $restRepresentativeCompanyUserCollectionResponseTransfer
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        $restResource = $this->restResourceBuilder->createRestResource(
            RepresentativeCompanyUserRestApiConfig::RESOURCE_REPRESENTATIVE_COMPANY_USER_REST_API,
            null,
            $restRepresentativeCompanyUserCollectionResponseTransfer,
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @param \Generated\Shared\Transfer\RestErrorMessageTransfer|null $restErrorMessageTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildErrorResponse(?RestErrorMessageTransfer $restErrorMessageTransfer = null): RestResponseInterface
    {
        if ($restErrorMessageTransfer === null) {
            $restErrorMessageTransfer = (new RestErrorMessageTransfer())
                ->setCode((string)RepresentativeCompanyUserRestApiConfig::RESPONSE_CODE_USER_IS_NOT_ALLOWED_TO_ADD_REPRESENTATION)
                ->setStatus(Response::HTTP_FORBIDDEN)
                ->setDetail(RepresentativeCompanyUserRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_ALLOWED_TO_ADD_REPRESENTATION);

            return $this->restResourceBuilder
                ->createRestResponse()
                ->addError($restErrorMessageTransfer);
        }

        if (str_starts_with($restErrorMessageTransfer->getDetail(), 'Unable to execute INSERT statement')) {
            $restErrorMessageTransfer->setDetail(RepresentativeCompanyUserRestApiConstants::PROBABLY_DUPLICATED_CONTENT)->setStatus(Response::HTTP_CONFLICT);
        }

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\RestRepresentativeCompanyUserResponseTransfer $restRepresentativeCompanyUserResponseTransfer
     *
     * @return string|null
     */
    protected function getUuidFromRestRepresentativeCompanyUserResponse(
        RestRepresentativeCompanyUserResponseTransfer $restRepresentativeCompanyUserResponseTransfer
    ): ?string {
        $representativeCompanyUser = $restRepresentativeCompanyUserResponseTransfer->getRepresentation();

        if ($representativeCompanyUser === null) {
            return null;
        }

        return $representativeCompanyUser->getUuid();
    }
}
