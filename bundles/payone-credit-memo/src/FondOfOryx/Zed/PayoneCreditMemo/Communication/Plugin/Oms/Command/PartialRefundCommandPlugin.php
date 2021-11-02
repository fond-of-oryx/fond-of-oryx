<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Communication\Plugin\Oms\Command;

use FondOfOryx\Shared\CreditMemo\CreditMemoConstants;
use FondOfOryx\Shared\CreditMemo\CreditMemoRefundHelperTrait;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Generated\Shared\Transfer\RefundResponseTransfer;
use Generated\Shared\Transfer\RefundTransfer;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use SprykerEco\Zed\Payone\Communication\Plugin\Oms\Command\PartialRefundCommandPlugin as SprykerEcoPartialRefundCommandPlugin;

/**
 * @method \FondOfOryx\Zed\PayoneCreditMemo\Communication\PayoneCreditMemoCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\PayoneCreditMemo\Business\PayoneCreditMemoFacadeInterface getFacade()
 */
class PartialRefundCommandPlugin extends SprykerEcoPartialRefundCommandPlugin
{
    use CreditMemoRefundHelperTrait;

    /**
     * @var string
     */
    public const REFUND_APPROVED = 'APPROVED';

    /**
     * @api
     *
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function run(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        $creditMemos = $this->getFactory()->getCreditMemoFacade()->getCreditMemosBySalesOrderItems($orderItems);
        $creditMemos = $this->resolveAndPrepareCreditMemos($creditMemos);

        $refundItems = [];
        foreach ($creditMemos as $creditMemoEntity) {
            $refundItems = array_merge(
                $refundItems,
                $this->getRefundableItemsByCreditMemo($creditMemoEntity, $orderItems),
            );
        }

        $results = [];
        foreach ($creditMemos as $creditMemoReference => $creditMemoEntity) {
            $creditMemoUpdateTransfer = $this->prepareCreditMemoUpdateTransfer();
            $results[$creditMemoReference] = $creditMemoUpdateTransfer->getInProgress();
            if (array_key_exists($creditMemoReference, $refundItems)) {
                $itemsToRefund = $this->resolveAndCheckItemsForRefund($refundItems[$creditMemoReference]);
                $refundTransfer = $this->getFactory()->getRefundFacade()->calculateRefund($itemsToRefund, $orderEntity);

                if ($refundTransfer->getAmount() !== $creditMemoEntity->getTotalAmount()) {
                    $creditMemoUpdateTransfer->setErrorMessage(sprintf('Calculated refund amount of %s is not the same as given amount of %s', $refundTransfer->getAmount(), $creditMemoEntity->getTotalAmount()));
                    $creditMemoUpdateTransfer->setState(sprintf(CreditMemoConstants::STATE_ERROR));
                    $this->updateCreditMemo($creditMemoEntity, $creditMemoUpdateTransfer);

                    continue;
                }

                if ($this->isRefundableAmount($refundTransfer)) {
                    $orderTransfer = $this->getFactory()->getSalesFacade()->getOrderByIdSalesOrder($orderEntity->getIdSalesOrder());

                    $payonePartialOperationTransfer = (new PayonePartialOperationRequestTransfer())
                        ->setOrder($orderTransfer)
                        ->setRefund($refundTransfer);

                    foreach ($orderItems as $orderItem) {
                        $payonePartialOperationTransfer->addSalesOrderItemId($orderItem->getIdSalesOrderItem());
                    }

                    $response = $this->getFactory()->getPayoneFacade()->executePartialRefund($payonePartialOperationTransfer);
                    $results[$creditMemoReference] = $response;
                    $this->handleRefundResponse($creditMemoUpdateTransfer, $response, $refundTransfer);

                    if ($creditMemoUpdateTransfer->getWasRefundSuccessful() === true) {
                        $this->getFactory()->getRefundFacade()->saveRefund($refundTransfer);
                    }
                }
            }

            $this->updateCreditMemo($creditMemoEntity, $creditMemoUpdateTransfer);
        }

        return [];
    }

    /**
     * @param \Generated\Shared\Transfer\RefundResponseTransfer $refundResponseTransfer
     *
     * @return string
     */
    protected function getState(RefundResponseTransfer $refundResponseTransfer): string
    {
        $status = $refundResponseTransfer->getBaseResponse()->getStatus();
        if ($status === static::REFUND_APPROVED) {
            return CreditMemoConstants::STATE_COMPLETE;
        }

        return CreditMemoConstants::STATE_ERROR;
    }

    /**
     * @param \Generated\Shared\Transfer\RefundResponseTransfer $refundResponseTransfer
     *
     * @return bool
     */
    protected function wasSuccessfullyRefunded(RefundResponseTransfer $refundResponseTransfer): bool
    {
        $state = $this->getState($refundResponseTransfer);
        if ($state === CreditMemoConstants::STATE_COMPLETE) {
            return true;
        }

        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\RefundResponseTransfer $refundResponseTransfer
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     *
     * @return int
     */
    protected function getRefundedAmount(
        RefundResponseTransfer $refundResponseTransfer,
        RefundTransfer $refundTransfer
    ): int {
        if ($this->wasSuccessfullyRefunded($refundResponseTransfer)) {
            return $refundTransfer->getAmount();
        }

        return 0;
    }

    /**
     * @param \Generated\Shared\Transfer\RefundResponseTransfer $refundResponseTransfer
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     *
     * @return int
     */
    protected function getRefundedTaxAmount(
        RefundResponseTransfer $refundResponseTransfer,
        RefundTransfer $refundTransfer
    ): int {
        if ($this->wasSuccessfullyRefunded($refundResponseTransfer)) {
            return 0; //ToDo get or calculate tax
        }

        return 0;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoUpdateTransfer
     * @param \Generated\Shared\Transfer\RefundResponseTransfer $response
     *
     * @return void
     */
    protected function handleErrorStuff(
        CreditMemoTransfer $creditMemoUpdateTransfer,
        RefundResponseTransfer $response
    ): void {
        if ($this->wasSuccessfullyRefunded($response) === false) {
            $creditMemoUpdateTransfer->setErrorCode($response->getBaseResponse()->getErrorCode());
            $creditMemoUpdateTransfer->setErrorMessage($response->getBaseResponse()->getErrorMessage());
        }
    }

    /**
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    protected function prepareCreditMemoUpdateTransfer(): CreditMemoTransfer
    {
        $creditMemoUpdateTransfer = new CreditMemoTransfer();
        $creditMemoUpdateTransfer->setInProgress(false)
            ->setWasRefundSuccessful(false)
            ->setProcessed(true)
            ->setProcessedAt(time())
            ->setRefundedAmount(0)
            ->setRefundedTaxAmount(0);

        return $creditMemoUpdateTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoUpdateTransfer
     * @param \Generated\Shared\Transfer\RefundResponseTransfer $response
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     *
     * @return void
     */
    protected function handleRefundResponse(
        CreditMemoTransfer $creditMemoUpdateTransfer,
        RefundResponseTransfer $response,
        RefundTransfer $refundTransfer
    ): void {
        $creditMemoUpdateTransfer->setState($this->getState($response))
            ->setWasRefundSuccessful($this->wasSuccessfullyRefunded($response))
            ->setRefundedAmount($this->getRefundedAmount($response, $refundTransfer))
            ->setRefundedTaxAmount($this->getRefundedTaxAmount($response, $refundTransfer))
            ->setTransactionId($response->getTxid());

        $this->handleErrorStuff($creditMemoUpdateTransfer, $response);
    }
}
