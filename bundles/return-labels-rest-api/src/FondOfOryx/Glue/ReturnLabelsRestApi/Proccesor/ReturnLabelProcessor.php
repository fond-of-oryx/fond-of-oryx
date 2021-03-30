<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor;

use FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface;
use FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiConfig;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\PermissionAwareTrait;
use Symfony\Component\HttpFoundation\Response;

class ReturnLabelProcessor implements ReturnLabelProcessorInterface
{
    use PermissionAwareTrait;

    /**
     * @var \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface
     */
    protected $client;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $resourceBuilder;

    /**
     * @param \FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface $client
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $resourceBuilder
     */
    public function __construct(
        ReturnLabelsRestApiClientInterface $client,
        RestResourceBuilderInterface $resourceBuilder
    ) {
        $this->client = $client;
        $this->resourceBuilder = $resourceBuilder;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer
     */
    public function getReturnLabel(
        RestRequestInterface $restRequest,
        RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
    ): RestResponseInterface {
        $restResponse = $this->resourceBuilder->createRestResponse();

        $returnLabelsRestApiTransfer = $this->createReturnLabelsRestApiTransfer(
            $restRequest,
            $restReturnLabelRequestAttributesTransfer
        );

        if ($this->hasPermissionsToReadCompanyUnitAddress($returnLabelsRestApiTransfer) === false) {
            $restErrorMessageTransfer = (new RestErrorMessageTransfer())
                ->setCode(ReturnLabelsRestApiConfig::RESPONSE_CODE_NO_PERMISSION)
                ->setStatus(Response::HTTP_BAD_REQUEST)
                ->setDetail(ReturnLabelsRestApiConfig::RESPONSE_DETAIL_NO_PERMISSION);

            return $restResponse->addError($restErrorMessageTransfer);
        }

        $returnLabelRestApiResponseTransfer = $this->client->getReturnLabelAction($companyUnitAddressTransfer);

        $restResource = $this->resourceBuilder->createRestResource(
            ReturnLabelsRestApiConfig::RESOURCE_RETURN_LABELS_REST_API,
            $companyUnitAddressTransfer->getUuid(),
            $returnLabelRestApiResponseTransfer
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    protected function hasPermissionsToReadCompanyUnitAddress(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): ?CompanyUnitAddressTransfer {
        $companyUserTransfer = (new CompanyUserTransfer())
            ->setCompanyUserReference($returnLabelsRestApiTransfer->getCompanyUserReference());

        $companyUserResponseTransfer = $this->client->findCompanyUserByCompanyUserReference($companyUserTransfer);
        $companyUnitAddressResponseTransfer = $this->client->findCompanyUnitAddressByExternalReference($returnLabelsRestApiTransfer);

        if (
            $companyUserResponseTransfer->getCompanyUser() === null ||
            $companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer() === null
        ) {
            return false;
        }

        return $companyUserResponseTransfer->getCompanyUser()->getFkCompany() === $companyUnitAddressResponseTransfer->getCompanyUnitAddressTransfer()->getFkCompany();
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelsRestApiTransfer
     */
    protected function createReturnLabelsRestApiTransfer(
        RestRequestInterface $restRequest,
        RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
    ): ReturnLabelsRestApiTransfer {
        return (new ReturnLabelsRestApiTransfer())
            ->setRestUserNaturalIndetifier($restRequest->getRestUser()->getNaturalIdentifier())
            ->setCustomerId($restRequest->getRestUser()->getSurrogateIdentifier())
            ->setCompanyUserReference($restReturnLabelRequestAttributesTransfer->getCompanyUserReference())
            ->setCompanyUnitAddressExternalReference($restReturnLabelRequestAttributesTransfer->getCompanyUnitAddressExternalReference());
    }
}
