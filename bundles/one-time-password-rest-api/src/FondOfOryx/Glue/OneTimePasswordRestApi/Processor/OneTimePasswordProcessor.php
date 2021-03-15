<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi\Processor;

use FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiClientInterface;
use FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class OneTimePasswordProcessor implements OneTimePasswordProcessorInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @var \FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiClientInterface
     */
    protected $oneTimePasswordClient;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     * @param \FondOfOryx\Client\OneTimePasswordRestApi\OneTimePasswordRestApiClientInterface $oneTimePasswordClient
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder,
        OneTimePasswordRestApiClientInterface $oneTimePasswordClient
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
        $this->oneTimePasswordClient = $oneTimePasswordClient;
    }

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     * @param \Generated\Shared\Transfer\RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function requestOneTimePasswordEmail(
        RestRequestInterface $restRequest,
        RestOneTimePasswordRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
    ): RestResponseInterface {
        if (!$restOneTimePasswordRequestAttributesTransfer->getEmail()) {
            return $this->createEmailRequiredError();
        }

        $RestOneTimePasswordResponseTransfer = $this->oneTimePasswordClient->requestOneTimePassword(
            $restOneTimePasswordRequestAttributesTransfer
        );

        return $this->restResourceBuilder
            ->createRestResponse()
            ->setStatus(204);
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected function createEmailRequiredError(): RestResponseInterface
    {
        $restErrorMessageTransfer = new RestErrorMessageTransfer();

        $restErrorMessageTransfer->setStatus(400)
            ->setCode(OneTimePasswordRestApiConfig::EMAIL_REQUIRED_ERROR_CODE)
            ->setDetail(OneTimePasswordRestApiConfig::EMAIL_REQUIRED_ERROR_DETAIL);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
