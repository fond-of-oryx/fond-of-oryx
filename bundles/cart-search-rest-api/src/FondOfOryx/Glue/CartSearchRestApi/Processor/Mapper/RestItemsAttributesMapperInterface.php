<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\RestItemsAttributesTransfer;

interface RestItemsAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return \Generated\Shared\Transfer\RestItemsAttributesTransfer
     */
    public function fromItem(ItemTransfer $itemTransfer): RestItemsAttributesTransfer;
}
