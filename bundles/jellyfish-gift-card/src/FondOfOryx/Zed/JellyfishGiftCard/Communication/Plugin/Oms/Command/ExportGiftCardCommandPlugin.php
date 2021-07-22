<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Communication\Plugin\Oms\Command;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Oms\Dependency\Plugin\Command\CommandByItemInterface;

/**
 * @method \FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig getConfig()
 * @method \FondOfOryx\Zed\JellyfishGiftCard\Business\JellyfishGiftCardFacadeInterface getFacade()
 */
class ExportGiftCardCommandPlugin extends AbstractPlugin implements CommandByItemInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function run(SpySalesOrderItem $orderItem, ReadOnlyArrayObject $data): array
    {
        $this->getFacade()->exportGiftCard($orderItem, $data);

        return [];
    }
}
