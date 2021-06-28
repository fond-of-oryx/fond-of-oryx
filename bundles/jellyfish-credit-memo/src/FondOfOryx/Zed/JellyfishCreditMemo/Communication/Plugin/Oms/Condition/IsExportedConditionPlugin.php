<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Communication\Plugin\Oms\Condition;

use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;

/**
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Communication\JellyfishCreditMemoCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Business\JellyfishCreditMemoFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\JellyfishCreditMemoConfig getConfig()
 */
class IsExportedConditionPlugin extends AbstractPlugin implements ConditionInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem)
    {
        $this->getFactory();

        return true;
    }
}
