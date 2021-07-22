<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Exporter;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

interface GiftCardExporterInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return void
     */
    public function export(SpySalesOrderItem $orderItem, ReadOnlyArrayObject $data): void;
}
