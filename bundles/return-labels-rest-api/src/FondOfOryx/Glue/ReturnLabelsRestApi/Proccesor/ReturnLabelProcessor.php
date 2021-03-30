<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor;

use FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface;
use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Generated\Shared\Transfer\RestUserTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiAttributesTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiConfig;
use Spryker\Glue\Kernel\PermissionAwareTrait;
use Symfony\Component\HttpFoundation\Response;
use FondOfSpryker\Client\CompanyUnitAddressPermission\Plugin\ReadCompanyUnitAddressPermissionPlugin;

class ReturnLabelProcessor implements ReturnLabelProcessorInterface
{
    use PermissionAwareTrait;

    /**
     * @var ReturnLabelsRestApiClientInterface
     */
    protected $client;

    /**
     * @var RestResourceBuilderInterface
     */
    protected $resourceBuilder;

    /**
     * @param ReturnLabelsRestApiClientInterface $client
     * @param RestResourceBuilderInterface $resourceBuilder
     */
    public function __construct(
        ReturnLabelsRestApiClientInterface $client,
        RestResourceBuilderInterface $resourceBuilder
    ) {
        $this->client = $client;
        $this->resourceBuilder = $resourceBuilder;
    }

    /**
     * @param RestRequestInterface $restRequest
     * @param RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
     *
     * @return ReturnLabelRestApiResponseTransfer
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

        $companyUnitAddressTransfer = $this->hasPermissionsToReadCompanyUnitAddress($returnLabelsRestApiTransfer);

        if ($companyUnitAddressTransfer === null) {
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
     * @param ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return CompanyUnitAddressTransfer|null
     */
    protected function hasPermissionsToReadCompanyUnitAddress(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): ?CompanyUnitAddressTransfer {
        $companyUserTransfer = (new CompanyUserTransfer())
            ->setCompanyUserReference($returnLabelsRestApiTransfer->getCompanyUserReference());

        $companyUserResponseTransfer = $this->client->findCompanyUserByCompanyUserReference($companyUserTransfer);
        $companyUnitAddressResponseTransfer = $this->client->findCompanyUnitAddressByExternalReference($returnLabelsRestApiTransfer);

        var_dump($companyUserResponseTransfer->getCompanyUser()->getFkCompany());
        var_dump($companyUnitAddressResponseTransfer);
        die();

        /*$companyUnitAddressTransfer = $this->client->findCompanyUnitAddressByUuid($returnLabelsRestApiTransfer);

        $companyUserResponseTransfer = $this->client->findCompanyUserByCompanyUserReference(
            (new CompanyUserTransfer)
                ->setCompanyUserReference($returnLabelsRestApiTransfer->getCompanyUserReference())
        );

        var_dump($companyUserResponseTransfer);

        if ($companyUnitAddressTransfer === null) {
            return null;
        }

        return $companyUnitAddressTransfer;*/
    }

    /**
     * @param RestRequestInterface $restRequest
     * @param RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
     *
     * @return ReturnLabelsRestApiTransfer
     */
    protected function createReturnLabelsRestApiTransfer(
        RestRequestInterface $restRequest,
        RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
    ): ReturnLabelsRestApiTransfer {
        return (new ReturnLabelsRestApiTransfer())
            ->setRestUserNaturalIndetifier($restRequest->getRestUser()->getNaturalIdentifier())
            ->setCustomerId($restRequest->getRestUser()->getSurrogateIdentifier())
            ->setCompanyUserReference($restReturnLabelRequestAttributesTransfer->getCompanyUserReference())
            ->setCompanyUnitAddressExternalReference($restReturnLabelRequestAttributesTransfer->getCompanyUnitAddressExternalReference())
        ;
    }
}
