<?php

namespace FondOfOryx\Zed\PrepaymentCreditMemo\Business\Model\Payment;

use FondOfOryx\Shared\CreditMemo\CreditMemoRefundHelperTrait;
use FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToCreditMemoInterface;
use FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToRefundInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class Refund implements RefundInterface
{
    use CreditMemoRefundHelperTrait;

    /**
     * @var \FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToRefundInterface
     */
    protected $refundFacade;

    /**
     * @var \FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToCreditMemoInterface
     */
    protected $creditMemoFacade;

    /**
     * @param \FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToRefundInterface $refundFacade
     * @param \FondOfOryx\Zed\PrepaymentCreditMemo\Dependency\Facade\PrepaymentCreditMemoToCreditMemoInterface $creditMemoFacade
     */
    public function __construct(
        PrepaymentCreditMemoToRefundInterface $refundFacade,
        PrepaymentCreditMemoToCreditMemoInterface $creditMemoFacade
    ) {
        $this->refundFacade = $refundFacade;
        $this->creditMemoFacade = $creditMemoFacade;
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return bool
     */
    public function refund(array $salesOrderItems, SpySalesOrder $salesOrderEntity): bool
    {
        $creditMemoEntities = $this->creditMemoFacade->getCreditMemosBySalesOrderItems($salesOrderItems);

        $results = $this->startRefund($salesOrderItems, $salesOrderEntity, $creditMemoEntities);

        return $this->validateRefundResult($results);
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return bool
     */
    public function refundBySalesOrder(array $salesOrderItems, SpySalesOrder $salesOrderEntity): bool
    {
        $creditMemoEntities = $this->creditMemoFacade->getCreditMemoBySalesOrderId($salesOrderEntity->getIdSalesOrder());

        $results = $this->startRefund($salesOrderItems, $salesOrderEntity, $creditMemoEntities);

        return $this->validateRefundResult($results);
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return bool
     */
    public function refundCreditMemo(CreditMemoTransfer $creditMemoTransfer): bool
    {
        $salesOrderEntity = $this->creditMemoFacade->getSalesOrderByCreditMemo($creditMemoTransfer);
        $salesOrderItemEntities = $salesOrderEntity->getItems();

        $salesOrderItems = [];
        foreach ($creditMemoTransfer->getItems() as $itemTransfer) {
            foreach ($salesOrderItemEntities->getData() as $salesOrderItemEntity) {
                if ($salesOrderItemEntity->getIdSalesOrderItem() === $itemTransfer->getFkSalesOrderItem()) {
                    $salesOrderItems[] = $salesOrderItemEntity;
                }
            }
        }

        return $this->refund($salesOrderItems, $salesOrderEntity);
    }

    /**
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrderItem[] $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo[] $creditMemoEntities
     *
     * @return mixed
     */
    protected function startRefund(
        array $salesOrderItems,
        SpySalesOrder $salesOrderEntity,
        array $creditMemoEntities
    ) {
        $creditMemos = $this->resolveAndPrepareCreditMemos($creditMemoEntities);

        $refundItems = [];
        foreach ($creditMemos as $creditMemoEntity) {
            $refundItems = array_merge(
                $refundItems,
                $this->getRefundableItemsByCreditMemo($creditMemoEntity, $salesOrderItems)
            );
        }

        $results = [];
        foreach ($creditMemos as $creditMemoReference => $creditMemoEntity) {
            $creditMemoUpdateTransfer = new CreditMemoTransfer();
            $creditMemoUpdateTransfer->setInProgress(false);
            $results[$creditMemoReference] = $creditMemoUpdateTransfer->getInProgress();
            if (array_key_exists($creditMemoReference, $refundItems) && is_array($refundItems[$creditMemoReference])) {
                $itemsToRefund = $this->resolveAndCheckItemsForRefund($refundItems[$creditMemoReference]);
                $refundTransfer = $this->refundFacade->calculateRefund($itemsToRefund, $salesOrderEntity);

                if ($this->isRefundableAmount($refundTransfer)) {
                    $results[$creditMemoReference] = $this->refundFacade->saveRefund($refundTransfer);
                    $creditMemoUpdateTransfer->setProcessed(true);
                    $creditMemoUpdateTransfer->setProcessedAt(time());
                    $creditMemoUpdateTransfer->setRefundedAmount($refundTransfer->getAmount());
                }
            }
            $this->updateCreditMemo($creditMemoEntity, $creditMemoUpdateTransfer);
        }

        return $results;
    }
}
