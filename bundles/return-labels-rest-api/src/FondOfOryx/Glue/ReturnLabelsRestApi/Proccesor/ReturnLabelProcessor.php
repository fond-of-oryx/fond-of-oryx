<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor;

use FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface;
use FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
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
        $restReturnLabelRequestTransfer = $this->createRestReturnLabelRequest(
            $restRequest,
            $restReturnLabelRequestAttributesTransfer
        );

        $restReturnLabelResponseTransfer = $this->client->generateReturnLabel($restReturnLabelRequestTransfer);

        if (!$restReturnLabelResponseTransfer->isSuccess()) {
            return $restResponse->addError((new RestErrorMessageTransfer())
                ->setStatus(Response::HTTP_BAD_REQUEST)
                ->setCode(ReturnLabelsRestApiConfig::ReturnLabelsRestApiConfig)
                ->setDetail(sprintf(
                    ReturnLabelsRestApiConfig::RESPONSE_DETAIL_NO_ADDRESS_FOUND,
                    $restReturnLabelRequestTransfer->getIdCustomer()
                )));
        }

        $restResource = $this->resourceBuilder->createRestResource(
            ReturnLabelsRestApiConfig::RESOURCE_RETURN_LABELS_REST_API,
            $companyUnitAddressTransfer->getUuid(),
            $returnLabelRestApiResponseTransfer
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
     */
    protected function createRestReturnLabelRequest(
        RestRequestInterface $restRequest,
        RestReturnLabelRequestAttributesTransfer $restReturnLabelRequestAttributesTransfer
    ): RestReturnLabelRequestTransfer {
        return (new RestReturnLabelRequestTransfer())
            ->setIdCustomer($restRequest->getRestUser()->getSurrogateIdentifier())
            ->setCompanyUnitAddressUuid($restReturnLabelRequestAttributesTransfer->getCompanyUnitAddressUuid());
    }
}
