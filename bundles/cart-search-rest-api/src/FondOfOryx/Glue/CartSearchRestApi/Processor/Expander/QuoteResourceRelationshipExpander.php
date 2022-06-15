<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Expander;

use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestResourceMapperInterface;
use Generated\Shared\Transfer\QuoteListTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestLinkInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class QuoteResourceRelationshipExpander implements QuoteResourceRelationshipExpanderInterface
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestResourceMapperInterface
     */
    protected $restResourceMapper;

    /**
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestResourceMapperInterface $restResourceMapper
     */
    public function __construct(RestResourceMapperInterface $restResourceMapper)
    {
        $this->restResourceMapper = $restResourceMapper;
    }

    /**
     * @param array<\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface> $resources
     * @param \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface $restRequest
     *
     * @return void
     */
    public function expand(array $resources, RestRequestInterface $restRequest): void
    {
        foreach ($resources as $resource) {
            /**
             * @var \Spryker\Shared\Kernel\Transfer\AbstractTransfer|null $payload
             */
            $payload = $resource->getPayload();

            if (!$payload instanceof QuoteListTransfer) {
                continue;
            }

            foreach ($payload->getQuotes() as $quoteTransfer) {
                foreach ($quoteTransfer->getItems() as $itemTransfer) {
                    $restResource = $this->restResourceMapper->fromItem($itemTransfer)
                        ->addLink(
                            RestLinkInterface::LINK_SELF,
                            sprintf(
                                '%s/%s/%s/%s',
                                CartSearchRestApiConfig::RESOURCE_CARTS,
                                $quoteTransfer->getUuid(),
                                CartSearchRestApiConfig::RESOURCE_CART_ITEMS,
                                $itemTransfer->getGroupKey(),
                            ),
                        );

                    $resource->addRelationship($restResource);
                }
            }
        }
    }
}
