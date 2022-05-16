<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Filter;

use Generated\Shared\Transfer\LocaleTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

interface LocaleFilterInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $spySalesOrderItem
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function fromSpySalesOrderItem(SpySalesOrderItem $spySalesOrderItem): LocaleTransfer;
}
