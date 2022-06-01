<?php

namespace FondOfOryx\Zed\NoPaymentCreditMemo\Business\Model\Payment;

use FondOfOryx\Shared\CreditMemo\CreditMemoRefundHelperTrait;
use FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToGiftCardProportionalValueInterface;
use FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToRefundInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ProportionalGiftCardValueTransfer;
use Generated\Shared\Transfer\RefundTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

class Refund implements RefundInterface
{
    use CreditMemoRefundHelperTrait;

    /**
     * @var \FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToRefundInterface
     */
    protected $refundFacade;

    /**
     * @var \FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToGiftCardProportionalValueInterface
     */
    protected $giftCardProportionalValue;

    /**
     * @param \FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToRefundInterface $refundFacade
     * @param \FondOfOryx\Zed\NoPaymentCreditMemo\Dependency\Facade\NoPaymentCreditMemoToGiftCardProportionalValueInterface $giftCardProportionalValue
     */
    public function __construct(
        NoPaymentCreditMemoToRefundInterface $refundFacade,
        NoPaymentCreditMemoToGiftCardProportionalValueInterface $giftCardProportionalValue
    ) {
        $this->refundFacade = $refundFacade;
        $this->giftCardProportionalValue = $giftCardProportionalValue;
    }

    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return bool
     */
    public function refund(array $salesOrderItems, SpySalesOrder $salesOrderEntity): bool
    {
        $results = $this->startRefund($salesOrderItems, $salesOrderEntity);

        return $this->validateRefundResult($results);
    }

    /**
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $salesOrderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $salesOrderEntity
     *
     * @return mixed
     */
    protected function startRefund(
        array $salesOrderItems,
        SpySalesOrder $salesOrderEntity
    ) {
        $creditMemoEntities = $salesOrderEntity->getFooCreditMemos();
        $creditMemos = $this->resolveAndPrepareCreditMemos($creditMemoEntities->getData());

        $refundItems = [];
        foreach ($creditMemos as $creditMemoEntity) {
            $refundItems = array_merge(
                $refundItems,
                $this->getRefundableItemsByCreditMemo($creditMemoEntity, $salesOrderItems),
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
                    $this->createProportionalGiftCardValues($refundTransfer);
                    $creditMemoUpdateTransfer->setProcessed(true);
                    $creditMemoUpdateTransfer->setProcessedAt(time());
                    $creditMemoUpdateTransfer->setRefundedAmount($refundTransfer->getAmount());
                }
            }
            $this->updateCreditMemo($creditMemoEntity, $creditMemoUpdateTransfer);
        }

        return $results;
    }

    /**
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     *
     * @return void
     */
    protected function createProportionalGiftCardValues(RefundTransfer $refundTransfer)
    {
        foreach ($refundTransfer->getItems() as $item) {
            $transfer = new ProportionalGiftCardValueTransfer();
            $transfer
                ->setValue($item->getRefundableAmount())
                ->setOrderReference($item->getOrderReference())
                ->setSku($item->getSku())
                ->setFkSalesOrderItem($item->getIdSalesOrderItem())
                ->setFkSalesOrder($item->getFkSalesOrder());

            $this->giftCardProportionalValue->findOrCreateProportionalGiftCardValue($transfer);
        }
    }
}
