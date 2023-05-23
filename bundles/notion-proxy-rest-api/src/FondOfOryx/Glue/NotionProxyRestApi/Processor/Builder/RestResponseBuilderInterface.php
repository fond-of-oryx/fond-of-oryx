<?php

namespace FondOfOryx\Glue\NotionProxyRestApi\Processor\Builder;

use Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

interface RestResponseBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer $restNotionProxyRequestResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRestResponse(
        RestNotionProxyRequestResponseTransfer $restNotionProxyRequestResponseTransfer
    ): RestResponseInterface;
}
