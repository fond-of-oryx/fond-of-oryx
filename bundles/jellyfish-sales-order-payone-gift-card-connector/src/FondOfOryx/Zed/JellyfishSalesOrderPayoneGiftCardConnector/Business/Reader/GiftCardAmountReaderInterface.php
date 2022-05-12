<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Reader;

use Generated\Shared\Transfer\ItemTransfer;

interface GiftCardAmountReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     *
     * @return int|null
     */
    public function getByItemTransfer(ItemTransfer $itemTransfer): ?int;
}
