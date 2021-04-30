<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Proccesor;

use FondOfOryx\Client\ReturnLabelsRestApi\ReturnLabelsRestApiClientInterface;
use FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;
use Spryker\Glue\Kernel\PermissionAwareTrait;

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
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function getReturnLabel(RestRequestInterface $restRequest): RestResponseInterface
    {
        $restResponse = $this->resourceBuilder->createRestResponse();
        $restReturnLabelRequestTransfer = $this->createRestReturnLabelRequest($restRequest);

        $restReturnLabelResponseTransfer = $this->client->generateReturnLabel($restReturnLabelRequestTransfer);

        if (!$restReturnLabelResponseTransfer->getIsSuccessful()) {
            foreach ($restReturnLabelResponseTransfer->getErrors() as $error) {
                $error = (new RestErrorMessageTransfer())
                    ->setStatus($error->getType())
                    ->setCode($error->getValue())
                    ->setDetail($error->getMessage());

                $restResponse->addError($error);
            }

            return $restResponse;
        }

        $restResource = $this->resourceBuilder->createRestResource(
            ReturnLabelsRestApiConfig::RESOURCE_RETURN_LABELS_REST_API,
            $restReturnLabelRequestTransfer->getCompanyUnitAddressUuid(),
            $restReturnLabelResponseTransfer
        );

        return $restResponse->addResource($restResource);
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelRequestTransfer
     */
    protected function createRestReturnLabelRequest(RestRequestInterface $restRequest): RestReturnLabelRequestTransfer
    {
        return (new RestReturnLabelRequestTransfer())
            ->setIdCustomer($restRequest->getRestUser()->getSurrogateIdentifier())
            ->setCompanyUnitAddressUuid($restRequest->getResource()->getId());
    }
}
