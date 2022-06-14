<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\RestCartItemCalculationsTransfer;
use Generated\Shared\Transfer\RestItemsAttributesTransfer;

class RestItemsAttributesMapper implements RestItemsAttributesMapperInterface
{
     /**
      * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
      *
      * @return \Generated\Shared\Transfer\RestItemsAttributesTransfer
      */
    public function fromItem(ItemTransfer $itemTransfer): RestItemsAttributesTransfer
    {
        $restItemsAttributesTransfer = (new RestItemsAttributesTransfer())
            ->fromArray($itemTransfer->toArray(), true);

        $restCartItemCalculationsTransfer = $restItemsAttributesTransfer->getCalculations();

        if (!$restCartItemCalculationsTransfer) {
            $restCartItemCalculationsTransfer = new RestCartItemCalculationsTransfer();
        }

        return $restItemsAttributesTransfer->setCalculations(
            $restCartItemCalculationsTransfer->fromArray($itemTransfer->toArray(), true),
        );
    }
}
