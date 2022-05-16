<?php

namespace FondOfOryx\Zed\GiftCardCreditMemo\Business\Refund;

use Exception;
use Orm\Zed\GiftCardBalance\Persistence\SpyGiftCardBalanceLog;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class PartialGiftCardRefund implements PartialGiftCardRefundInterface
{
    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandler;

    /**
     * @var array<\Propel\Runtime\ActiveRecord\ActiveRecordInterface>
     */
    protected $persists;

    /**
     * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
     */
    public function __construct(TransactionHandlerInterface $transactionHandler)
    {
        $this->transactionHandler = $transactionHandler;
    }

    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function executePartialRefund(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array
    {
        $persists = [];

        foreach ($orderEntity->getSpyGiftCardBalanceLogs() as $balanceLog) {
            $persists = $this->calculateBalance($orderEntity, $orderItems, $balanceLog, $persists);
        }

        $this->persistEntities($persists);

        return [];
    }

    /**
     * @param array<\Propel\Runtime\ActiveRecord\ActiveRecordInterface> $persists
     *
     * @return bool
     */
    protected function persistEntities(array $persists): bool
    {
        return $this->transactionHandler->handleTransaction(
            function () use ($persists) {
                foreach ($persists as $entity) {
                    if (method_exists($entity, 'save')) {
                        $entity->save();

                        continue;
                    }

                    throw new Exception('Could not persist entity!');
                }

                return true;
            },
        );
    }

    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     *
     * @return array<int>
     */
    protected function collectRefundItemIds(array $orderItems): array
    {
        $refundItemIds = [];
        foreach ($orderItems as $orderItem) {
            $refundItemIds[] = $orderItem->getIdSalesOrderItem();
        }

        return $refundItemIds;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     *
     * @return array
     */
    protected function prepareCreditMemoRefunds(SpySalesOrder $orderEntity, array $orderItems): array
    {
        $refundItemsIds = $this->collectRefundItemIds($orderItems);
        $creditMemos = $orderEntity->getFooCreditMemos();

        $refundCreditMemoItems = [];
        foreach ($creditMemos as $creditMemo) {
            foreach ($creditMemo->getFooCreditMemoItems() as $fooCreditMemoItem) {
                $creditMemoFkSalesOrderId = $fooCreditMemoItem->getFkSalesOrderItem();
                if (in_array($creditMemoFkSalesOrderId, $refundItemsIds, true)) {
                    $refundCreditMemoItems[$creditMemo->getFkSalesOrder()][$creditMemoFkSalesOrderId] = $fooCreditMemoItem;
                }
            }
        }

        return $refundCreditMemoItems;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     * @param \Orm\Zed\GiftCardBalance\Persistence\SpyGiftCardBalanceLog $balanceLog
     * @param array<\Propel\Runtime\ActiveRecord\ActiveRecordInterface> $persists
     *
     * @return array<\Propel\Runtime\ActiveRecord\ActiveRecordInterface>
     */
    protected function calculateBalance(SpySalesOrder $orderEntity, array $orderItems, SpyGiftCardBalanceLog $balanceLog, array $persists): array
    {
        $balanceLogValue = $balanceLog->getValue();

        foreach ($this->prepareCreditMemoRefunds($orderEntity, $orderItems) as $fkSalesOrder => $fooCreditMemoItems) {
            foreach ($fooCreditMemoItems as $fooCreditMemoItem) {
                if ($balanceLog->getFkSalesOrder() !== $fkSalesOrder) {
                    continue;
                }
                foreach ($orderEntity->getFooProportionalGiftCardValues() as $proportionalGiftCardValue) {
                    $creditMemoItemCouponAmount = $fooCreditMemoItem->getCouponAmount();
                    $proportionalAmount = $proportionalGiftCardValue->getValue();
                    $hash = sprintf('%s.%s', $proportionalGiftCardValue->getIdProportionalGiftCardValue(), $fkSalesOrder);
                    if (
                        $creditMemoItemCouponAmount !== $proportionalAmount
                        || $proportionalGiftCardValue->getFkSalesOrder() !== $fkSalesOrder
                        || isset($persists[$hash]) === true
                    ) {
                        continue;
                    }
                    $balanceLogValue -= $proportionalAmount;
                    $persists[$hash] = $proportionalGiftCardValue->setIsRefund(true);
                }
            }
        }
        $persists[sprintf('balanceid%s', $balanceLog->getIdGiftCardBalanceLog())] = $balanceLog->setValue($balanceLogValue);

        return $persists;
    }
}
