<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use FondOfOryx\Glue\CartSearchRestApi\CartSearchRestApiConfig;
use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;

class RestResourceMapper implements RestResourceMapperInterface
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestItemsAttributesMapperInterface
     */
    protected $restItemsAttributesMapper;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilder;

    /**
     * @param \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestItemsAttributesMapperInterface $restItemsAttributesMapper
     * @param \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface $restResourceBuilder
     */
    public function __construct(
        RestItemsAttributesMapperInterface $restItemsAttributesMapper,
        RestResourceBuilderInterface $restResourceBuilder
    ) {
        $this->restItemsAttributesMapper = $restItemsAttributesMapper;
        $this->restResourceBuilder = $restResourceBuilder;
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    public function fromItem(ItemTransfer $itemTransfer): RestResourceInterface
    {
        $restItemsAttributesTransfer = $this->restItemsAttributesMapper->fromItem($itemTransfer);

        return $this->restResourceBuilder->createRestResource(
            CartSearchRestApiConfig::RESOURCE_CART_ITEMS,
            $itemTransfer->getGroupKey(),
            $restItemsAttributesTransfer,
        );
    }
}
