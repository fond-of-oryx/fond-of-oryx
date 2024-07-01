<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Processor\Builder;

use FondOfOryx\Glue\DocumentsRestApi\DocumentsRestApiConfig;
use Generated\Shared\Transfer\EasyApiResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

interface RestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\EasyApiResponseTransfer $easyApiClientResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildDocumentResponse(
        EasyApiResponseTransfer $easyApiClientResponseTransfer
    ): RestResponseInterface;

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
    ): RestResponseInterface;
}
