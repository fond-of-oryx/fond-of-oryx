<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Processor\Builder;

use ArrayObject;
use FondOfOryx\Shared\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiConstants;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilder implements RestResponseBuilderInterface
{
    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected RestResourceBuilderInterface $restResourceBuilder;

    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildEmptyRestResponse(): RestResponseInterface
    {
        return $this->restResourceBuilder->createRestResponse()
            ->setStatus(Response::HTTP_NO_CONTENT);
    }

    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\RestBusinessOnBehalfErrorTransfer> $restBusinessOnBehalfErrorTransfers
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildErrorRestResponse(ArrayObject $restBusinessOnBehalfErrorTransfers): RestResponseInterface
    {
        $restResponse = $this->restResourceBuilder
            ->createRestResponse();

        if ($restBusinessOnBehalfErrorTransfers->count() === 0) {
            $restErrorMessageTransfer = (new RestErrorMessageTransfer())
                ->setCode(BusinessOnBehalfRestApiConstants::ERROR_CODE_UNDEFINED_ERROR_OCCURRED)
                ->setStatus(Response::HTTP_BAD_REQUEST)
                ->setDetail(BusinessOnBehalfRestApiConstants::ERROR_MESSAGE_UNDEFINED_ERROR_OCCURRED);

            $restResponse->addError($restErrorMessageTransfer);
        }

        foreach ($restBusinessOnBehalfErrorTransfers as $restBusinessOnBehalfErrorTransfer) {
            $restErrorMessageTransfer = (new RestErrorMessageTransfer())
                ->setCode($restBusinessOnBehalfErrorTransfer->getErrorCode())
                ->setStatus(Response::HTTP_BAD_REQUEST)
                ->setDetail($restBusinessOnBehalfErrorTransfer->getMessage());

            $restResponse->addError($restErrorMessageTransfer);
        }

        return $restResponse;
    }
}
