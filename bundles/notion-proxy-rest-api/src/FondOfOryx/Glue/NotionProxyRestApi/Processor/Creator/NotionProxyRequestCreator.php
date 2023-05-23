<?php

namespace FondOfOryx\Glue\NotionProxyRestApi\Processor\Creator;

use FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiClientInterface;
use FondOfOryx\Glue\NotionProxyRestApi\Processor\Builder\RestResponseBuilderInterface;
use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class NotionProxyRequestCreator implements NotionProxyRequestCreatorInterface
{
    /**
     * @var \FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiClientInterface
     */
    protected NotionProxyRestApiClientInterface $client;

    /**
     * @var \FondOfOryx\Glue\NotionProxyRestApi\Processor\Builder\RestResponseBuilderInterface
     */
    protected RestResponseBuilderInterface $restResponseBuilder;

    /**
     * @param \FondOfOryx\Glue\NotionProxyRestApi\Processor\Builder\RestResponseBuilderInterface $restResponseBuilder
     * @param \FondOfOryx\Client\NotionProxyRestApi\NotionProxyRestApiClientInterface $client
     */
    public function __construct(
        RestResponseBuilderInterface $restResponseBuilder,
        NotionProxyRestApiClientInterface $client
    ) {
        $this->restResponseBuilder = $restResponseBuilder;
        $this->client = $client;
    }

    /**
     * @param \Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    public function create(
        RestNotionproxyRequestAttributesTransfer $restNotionProxyRequestAttributesTransfer,
        RestRequestInterface $restRequest
    ): RestResponseInterface {
        $restNotionProxyRequestResponseTransfer = $this->client
            ->sendRequest($restNotionProxyRequestAttributesTransfer);

        return $this->restResponseBuilder->buildRestResponse($restNotionProxyRequestResponseTransfer);
    }
}
