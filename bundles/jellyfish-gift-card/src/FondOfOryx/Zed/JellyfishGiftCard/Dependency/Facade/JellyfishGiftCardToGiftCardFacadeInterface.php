<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade;

use Generated\Shared\Transfer\GiftCardTransfer;

interface JellyfishGiftCardToGiftCardFacadeInterface
{
    /**
     * @param int $idSalesOrderItem
     *
     * @return \Generated\Shared\Transfer\GiftCardTransfer|null
     */
    public function findGiftCardByIdSalesOrderItem(int $idSalesOrderItem): ?GiftCardTransfer;
}
