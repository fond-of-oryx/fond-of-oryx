<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

interface JellyfishGiftCardFacadeInterface
{
    /**
     * Specifications:
     * - Export ordered gift card to jellyfish ms
     *
     * @api
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return void
     */
    public function exportGiftCard(SpySalesOrderItem $orderItem, ReadOnlyArrayObject $data): void;
}
