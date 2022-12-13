<?php

namespace FondOfOryx\Zed\Prepayment\Communication\Plugin\Oms\Condition;

use FondOfOryx\Shared\Prepayment\PrepaymentConstants;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Dependency\Plugin\Condition\ConditionInterface;

/**
 * @method \FondOfOryx\Zed\Prepayment\Communication\PrepaymentCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\Prepayment\Business\PrepaymentFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\Prepayment\PrepaymentConfig getConfig()
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
        $email = strtolower($orderItem->getOrder()->getEmail());

        return (
            $firstName !== PrepaymentConstants::FIRST_NAME_FOR_INVALID_TEST
            && $lastName !== PrepaymentConstants::LAST_NAME_FOR_INVALID_TEST
            && in_array($email, $this->getConfig()->getForceInvalidMailAddresses(), true) === false);
    }
}
