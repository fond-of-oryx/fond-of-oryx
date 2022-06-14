<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\ItemTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;

interface RestResourceMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    public function fromItem(ItemTransfer $itemTransfer): RestResourceInterface;
}
