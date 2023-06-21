<?php

namespace FondOfOryx\Glue\NotionProxyRestApi\Processor\Creator;

use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

interface NotionProxyRequestCreatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer $requestAttributesTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function create(
        RestNotionProxyRequestAttributesTransfer $requestAttributesTransfer,
        RestRequestInterface $restRequest
    ): RestResponseInterface;
}
