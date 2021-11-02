<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\Filter;

use ArrayObject;
use Generated\Shared\Transfer\ItemTransfer;

class SkuFilter implements SkuFilterInterface
{
    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return array<string>
     */
    public function filterFromItems(ArrayObject $itemTransfers): array
    {
        $skus = [];

        foreach ($itemTransfers as $itemTransfer) {
            $skus[] = $this->filterFromItem($itemTransfer);
        }

        return array_unique($skus);
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return string
     */
    public function filterFromItem(ItemTransfer $itemTransfer): string
    {
        return $itemTransfer->getSku();
    }
}
