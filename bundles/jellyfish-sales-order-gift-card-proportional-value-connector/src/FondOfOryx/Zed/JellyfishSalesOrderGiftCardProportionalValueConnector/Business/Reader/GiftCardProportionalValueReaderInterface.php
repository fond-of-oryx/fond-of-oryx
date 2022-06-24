<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Reader;

use Generated\Shared\Transfer\ItemTransfer;

interface GiftCardProportionalValueReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return int|null
     */
    public function getByItemTransfer(ItemTransfer $itemTransfer): ?int;
}
