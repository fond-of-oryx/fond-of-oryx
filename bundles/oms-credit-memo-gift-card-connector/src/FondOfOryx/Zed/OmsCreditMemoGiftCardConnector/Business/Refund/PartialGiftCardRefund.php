<?php

namespace FondOfOryx\Zed\OmsCreditMemoGiftCardConnector\Business\Refund;

use Exception;
use Orm\Zed\CreditMemo\Persistence\Map\FooCreditMemoTableMap;
use Orm\Zed\GiftCardBalance\Persistence\SpyGiftCardBalanceLog;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class PartialGiftCardRefund implements PartialGiftCardRefundInterface
{
    /**
     * @var array<string>
     */
    protected const CREDIT_MEMO_STATES = [
        FooCreditMemoTableMap::COL_STATE_COMPLETE,
        FooCreditMemoTableMap::COL_STATE_ERROR,
    ];

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
        $this->persists = [];

        foreach ($orderEntity->getSpyGiftCardBalanceLogs() as $balanceLog) {
            $this->persists = $this->calculateBalance($orderEntity, $orderItems, $balanceLog);
        }

        $this->persistEntities($this->persists);

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
            $creditMemoHash = sprintf('CreditMemo%s', $creditMemo->getIdCreditMemo());
            foreach ($creditMemo->getFooCreditMemoItems() as $fooCreditMemoItem) {
                $creditMemoFkSalesOrderId = $fooCreditMemoItem->getFkSalesOrderItem();
                if (in_array($creditMemoFkSalesOrderId, $refundItemsIds, true)) {
                    $refundCreditMemoItems[$creditMemo->getFkSalesOrder()][$creditMemoFkSalesOrderId] = $fooCreditMemoItem;
                    if (isset($this->persists[$creditMemoHash]) === false && in_array($creditMemo->getState(), static::CREDIT_MEMO_STATES, true) === false) {
                        $this->persists[$creditMemoHash] = $creditMemo->setState(FooCreditMemoTableMap::COL_STATE_COMPLETE);
                    }
                }
            }
        }

        return $refundCreditMemoItems;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     * @param \Orm\Zed\GiftCardBalance\Persistence\SpyGiftCardBalanceLog $balanceLog
     *
     * @return array<\Propel\Runtime\ActiveRecord\ActiveRecordInterface>
     */
    protected function calculateBalance(SpySalesOrder $orderEntity, array $orderItems, SpyGiftCardBalanceLog $balanceLog): array
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
                    $hash = sprintf('%s.%s', $fooCreditMemoItem->getFkSalesOrderItem(), $fkSalesOrder);
                    if (
                        $creditMemoItemCouponAmount !== $proportionalAmount
                        || $proportionalGiftCardValue->getFkSalesOrder() !== $fkSalesOrder
                        || isset($this->persists[$hash]) === true
                    ) {
                        continue;
                    }
                    $balanceLogValue -= $proportionalAmount;
                    $this->persists[$hash] = $proportionalGiftCardValue->setIsRefund(true);
                }
            }
        }
        $balanceLogValue = $this->handleExpenses($orderEntity, $balanceLogValue);
        $this->persists[sprintf('balanceid%s', $balanceLog->getIdGiftCardBalanceLog())] = $balanceLog->setValue($balanceLogValue);

        return $this->persists;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $spySalesOrder
     * @param int $balanceLogValue
     *
     * @return int
     */
    protected function handleExpenses(SpySalesOrder $spySalesOrder, int $balanceLogValue): int
    {
        $creditMemos = $spySalesOrder->getFooCreditMemos();
        $proportionalAmounts = $spySalesOrder->getFooProportionalGiftCardValues();
        foreach ($creditMemos as $creditMemo) {
            if ($creditMemo->getChargeAmount() === null) {
                continue;
            }

            foreach ($proportionalAmounts as $proportionalAmount) {
                if ($proportionalAmount->getFkSalesExpense() === null) {
                    continue;
                }
                $hash = sprintf('expenseid%s', $proportionalAmount->getFkSalesExpense());
                if (
                    isset($this->persists[$hash])
                    || $proportionalAmount->getFkSalesOrder() !== $creditMemo->getFkSalesOrder()
                ) {
                    continue;
                }
                $balanceLogValue -= $proportionalAmount->getValue();
                $this->persists[$hash] = $proportionalAmount->setIsRefund(true);
            }
        }

        return $balanceLogValue;
    }
}
