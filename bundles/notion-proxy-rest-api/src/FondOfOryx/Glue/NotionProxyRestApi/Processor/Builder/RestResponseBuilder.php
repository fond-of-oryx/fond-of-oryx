<?php

namespace FondOfOryx\Glue\NotionProxyRestApi\Processor\Builder;

use FondOfOryx\Glue\NotionProxyRestApi\NotionProxyRestApiConfig;
use Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;

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
     * @param \Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer $restNotionProxyRequestResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function buildRestResponse(
        RestNotionProxyRequestResponseTransfer $restNotionProxyRequestResponseTransfer
    ): RestResponseInterface {
        $restResponse = $this->restResourceBuilder->createRestResponse();

        return $restResponse->addResource($this->createNotionProxyResource($restNotionProxyRequestResponseTransfer));
    }

    /**
     * @param \Generated\Shared\Transfer\RestNotionProxyRequestResponseTransfer $restNotionProxyRequestResponseTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected function createNotionProxyResource(
        RestNotionProxyRequestResponseTransfer $restNotionProxyRequestResponseTransfer
    ): RestResourceInterface {
        return $this->restResourceBuilder
            ->createRestResource(
                NotionProxyRestApiConfig::RESOURCE_NOTION_PROXY,
                null,
                $restNotionProxyRequestResponseTransfer,
            );
    }
}
