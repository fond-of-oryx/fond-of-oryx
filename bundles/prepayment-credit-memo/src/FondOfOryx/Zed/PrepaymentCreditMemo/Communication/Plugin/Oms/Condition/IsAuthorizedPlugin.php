<?php

namespace FondOfOryx\Zed\PrepaymentCreditMemo\Communication\Plugin\Oms\Condition;

use FondOfOryx\Shared\PrepaymentCreditMemo\PrepaymentCreditMemoConstants;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;

/**
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\Communication\PrepaymentCreditMemoCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\Business\PrepaymentCreditMemoFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\PrepaymentCreditMemoConfig getConfig()
 */
class IsAuthorizedPlugin extends AbstractPlugin implements ConditionInterface
{
    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem $orderItem
     *
     * @return bool
     */
    public function check(SpySalesOrderItem $orderItem)
    {
        $firstName = $orderItem->getOrder()->getFirstName();
        $lastName = $orderItem->getOrder()->getLastName();

        return ($firstName !== PrepaymentCreditMemoConstants::FIRST_NAME_FOR_INVALID_TEST && $lastName !== PrepaymentCreditMemoConstants::LAST_NAME_FOR_INVALID_TEST);
    }
}
