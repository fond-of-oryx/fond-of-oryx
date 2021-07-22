<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Business\AbstractFacade;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

/**
 * @method \FondOfOryx\Zed\JellyfishGiftCard\Business\JellyfishGiftCardBusinessFactory getFactory()
 */
class JellyfishGiftCardFacade extends AbstractFacade implements JellyfishGiftCardFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return void
     */
    public function exportGiftCard(SpySalesOrderItem $orderItem, ReadOnlyArrayObject $data): void
    {
        $this->getFactory()->createGiftCardExport()->export($orderItem, $data);
    }
}
