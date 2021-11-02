<?php

namespace FondOfOryx\Zed\GiftCardRestriction\Business\Filter;

use ArrayObject;
use Generated\Shared\Transfer\ItemTransfer;

interface SkuFilterInterface
{
    /**
     * @param \ArrayObject<\Generated\Shared\Transfer\ItemTransfer> $itemTransfers
     *
     * @return array<string>
     */
    public function filterFromItems(ArrayObject $itemTransfers): array;

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return string
     */
    public function filterFromItem(ItemTransfer $itemTransfer): string;
}
