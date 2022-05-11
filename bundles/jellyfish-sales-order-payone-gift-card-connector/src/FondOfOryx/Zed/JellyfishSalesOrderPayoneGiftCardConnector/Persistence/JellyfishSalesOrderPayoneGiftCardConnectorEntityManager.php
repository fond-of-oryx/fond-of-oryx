<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence;

use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValue;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\JellyfishSalesOrderPayoneGiftCardConnectorPersistenceFactory getFactory()
 */
class JellyfishSalesOrderPayoneGiftCardConnectorEntityManager extends AbstractEntityManager implements JellyfishSalesOrderPayoneGiftCardConnectorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
     *
     * @return \Generated\Shared\Transfer\ProportionalGiftCardValueTransfer
     */
    public function findOrCreateProportionalGiftCardValue(
        ProportionalGiftCardValueTransfer $proportionalGiftCardValueTransfer
    ): ProportionalGiftCardValueTransfer {
        $fooProportionalGiftCardValueEntity = $this->findByFkSalesOrderAndFkSalesOrderItemAndFkSalesExpense(
            $proportionalGiftCardValueTransfer->getFkSalesOrder(),
            $proportionalGiftCardValueTransfer->getFkSalesOrderItem(),
            $proportionalGiftCardValueTransfer->getFkSalesExpense(),
        );

        $fooProportionalGiftCardValueEntity = $this->getFactory()
            ->createProportionalGiftCardValueMapper()
            ->mapTransferToEntity($proportionalGiftCardValueTransfer, $fooProportionalGiftCardValueEntity);

        $fooProportionalGiftCardValueEntity->save();

        return $this->getFactory()->createProportionalGiftCardValueMapper()->mapEntityToTransfer($fooProportionalGiftCardValueEntity);
    }

    /**
     * @param int $fkSalesOrder
     * @param int|null $fkSalesOrderItem
     * @param int|null $fkSalesExpense
     *
     * @return \Orm\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Persistence\FooProportionalGiftCardValue
     */
    protected function findByFkSalesOrderAndFkSalesOrderItemAndFkSalesExpense(
        int $fkSalesOrder,
        ?int $fkSalesOrderItem,
        ?int $fkSalesExpense
    ): FooProportionalGiftCardValue {
        return $this->getFactory()->createProportionalGiftCardValueQuery()
            ->filterByFkSalesOrder($fkSalesOrder)
            ->filterByFkSalesExpense($fkSalesExpense)
            ->filterByFkSalesOrderItem($fkSalesOrderItem)
            ->findOneOrCreate();
    }
}
