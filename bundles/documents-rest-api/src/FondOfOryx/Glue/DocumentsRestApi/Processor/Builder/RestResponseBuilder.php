<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Builder;

use FondOfOryx\Glue\DocumentsRestApi\DocumentsRestApiConfig;
use Generated\Shared\Transfer\EasyApiResponseTransfer;
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
     * @param \Generated\Shared\Transfer\EasyApiResponseTransfer $easyApiClientResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildDocumentResponse(
        EasyApiResponseTransfer $easyApiClientResponseTransfer
    ): RestResponseInterface {
        if (
            $easyApiClientResponseTransfer->getStatus() !== 'success'
            || $easyApiClientResponseTransfer->getHash() !== sha1($easyApiClientResponseTransfer->getData())
        ) {
            return $this->buildErrorRestResponse();
        }

        $restResponse = $this->restResourceBuilder->createRestResponse(1);

        $restResource = $this->restResourceBuilder->createRestResource(
            DocumentsRestApiConfig::RESOURCE_DOCUMENTS_API,
            null,
            $easyApiClientResponseTransfer,
        );

        return $restResponse
            ->addResource($restResource)
            ->setStatus($easyApiClientResponseTransfer->getStatusCode());
    }

    /**
     * @param string $details
     * @param string $code
     * @param int $status
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildErrorRestResponse(
        string $details = DocumentsRestApiConfig::ERROR_MESSAGE_UNEXPECTED,
        string $code = '500',
        int $status = Response::HTTP_INTERNAL_SERVER_ERROR
    ): RestResponseInterface {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode($code)
            ->setStatus($status)
            ->setDetail($details);

        return $this->restResourceBuilder
            ->createRestResponse()
            ->addError($restErrorMessageTransfer);
    }
}
