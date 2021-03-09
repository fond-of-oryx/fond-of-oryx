<?php

namespace FondOfOryx\Glue\CheckoutRestApi\Processor\Validation;

use FondOfOryx\Glue\CheckoutRestApi\CheckoutRestApiConfig;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestApiError implements RestApiErrorInterface
{
    /**
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface $restResponse
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function addPermissionDeniedErrorResponse(RestResponseInterface $restResponse): RestResponseInterface
    {
        $restErrorMessageTransfer = (new RestErrorMessageTransfer())
            ->setCode(CheckoutRestApiConfig::RESPONSE_CODE_ACCESS_DENIED)
            ->setStatus(Response::HTTP_FORBIDDEN)
            ->setDetail(CheckoutRestApiConfig::RESPONSE_MESSAGE_ACCESS_DENIED);

        return $restResponse->addError($restErrorMessageTransfer);
    }
}
