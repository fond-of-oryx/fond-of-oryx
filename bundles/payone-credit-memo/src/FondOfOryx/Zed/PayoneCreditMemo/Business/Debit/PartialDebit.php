<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Business\Debit;

use FondOfOryx\Shared\CreditMemo\CreditMemoConstants;
use FondOfOryx\Shared\CreditMemo\CreditMemoRefundHelperTrait;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToPayoneInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToRefundInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToSalesInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\DebitResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Generated\Shared\Transfer\RefundTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class PartialDebit implements PartialDebitInterface
{
    use CreditMemoRefundHelperTrait;

    /**
     * @var string
     */
    public const DEBIT_APPROVED = 'APPROVED';

    /**
     * @var \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoInterface
     */
    protected $creditMemoFacade;

    /**
     * @var \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToRefundInterface
     */
    protected $refundFacade;

    /**
     * @var \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToSalesInterface
     */
    protected $salesFacade;

    /**
     * @var \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToPayoneInterface
     */
    protected $payoneFacade;

    /**
     * @var array<\FondOfOryx\Zed\PayoneCreditMemoExtension\Dependency\Plugin\PayoneCreditMemoPreRefundPluginInterface>
     */
    protected $preDebitPlugins;

    /**
     * @param \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoInterface $creditMemoFacade
     * @param \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToRefundInterface $refundFacade
     * @param \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToSalesInterface $salesFacade
     * @param \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToPayoneInterface $payoneFacade
     * @param array<\FondOfOryx\Zed\PayoneCreditMemoExtension\Dependency\Plugin\PayoneCreditMemoPreRefundPluginInterface> $preDebitPlugins
     */
    public function __construct(
        PayoneCreditMemoToCreditMemoInterface $creditMemoFacade,
        PayoneCreditMemoToRefundInterface $refundFacade,
        PayoneCreditMemoToSalesInterface $salesFacade,
        PayoneCreditMemoToPayoneInterface $payoneFacade,
        array $preDebitPlugins
    ) {
        $this->creditMemoFacade = $creditMemoFacade;
        $this->refundFacade = $refundFacade;
        $this->salesFacade = $salesFacade;
        $this->payoneFacade = $payoneFacade;
        $this->preDebitPlugins = $preDebitPlugins;
    }

    /**
     * @api
     *
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array
     */
    public function executePartialDebit(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array
    {
        $creditMemos = $this->creditMemoFacade->getCreditMemosBySalesOrderItems($orderItems);
        $creditMemos = $this->resolveAndPrepareCreditMemos($creditMemos);

        $debitItems = $this->resolveDebitableItems($creditMemos, $orderItems);

        $results = [];
        foreach ($creditMemos as $creditMemoReference => $creditMemoEntity) {
            $creditMemoUpdateTransfer = $this->prepareCreditMemoUpdateTransfer();
            $results[$creditMemoReference] = $creditMemoUpdateTransfer->getInProgress();
            if (array_key_exists($creditMemoReference, $debitItems)) {
                $itemsToDebit = $this->resolveAndCheckItemsForRefund($debitItems[$creditMemoReference]);
                $refundTransfer = $this->refundFacade->calculateRefund($itemsToDebit, $orderEntity);

                if ($this->validateDebitAmounts($refundTransfer, $creditMemoEntity, $creditMemoUpdateTransfer) === false) {
                    continue;
                }

                if ($this->isRefundableAmount($refundTransfer)) {
                    $orderTransfer = $this->salesFacade->getOrderByIdSalesOrder($orderEntity->getIdSalesOrder());

                    $payonePartialOperationTransfer = $this->prepareDebitRequest($orderTransfer, $refundTransfer, $creditMemoEntity);

                    foreach ($orderItems as $orderItem) {
                        $payonePartialOperationTransfer->addSalesOrderItemId($orderItem->getIdSalesOrderItem());
                    }

                    $response = $this->payoneFacade->executePartialDebit($payonePartialOperationTransfer);
                    $results[$creditMemoReference] = $response;
                    $this->handleDebitResponse($creditMemoUpdateTransfer, $response, $refundTransfer);

                    if ($creditMemoUpdateTransfer->getWasRefundSuccessful() === true) {
                        $this->refundFacade->saveRefund($refundTransfer);
                    }
                }
            }

            $this->updateCreditMemo($creditMemoEntity, $creditMemoUpdateTransfer);
        }

        return [];
    }

    /**
     * @param array<\Orm\Zed\CreditMemo\Persistence\FooCreditMemo> $creditMemos
     * @param array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem> $orderItems
     *
     * @return array<string, array<\Orm\Zed\Sales\Persistence\SpySalesOrderItem>>
     */
    protected function resolveDebitableItems(array $creditMemos, array $orderItems): array
    {
        $debitItems = [];
        foreach ($creditMemos as $creditMemoEntity) {
            $debitItems = array_merge(
                $debitItems,
                $this->getRefundableItemsByCreditMemo($creditMemoEntity, $orderItems),
            );
        }

        return $debitItems;
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
     * @param \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer $partialOperationRequestTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    protected function executePreDebitPlugins(
        PayonePartialOperationRequestTransfer $partialOperationRequestTransfer,
        FooCreditMemo $creditMemoEntity
    ): PayonePartialOperationRequestTransfer {
        foreach ($this->preDebitPlugins as $preRefundPlugin) {
            $partialOperationRequestTransfer = $preRefundPlugin->execute($partialOperationRequestTransfer, $creditMemoEntity);
        }

        return $partialOperationRequestTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\DebitResponseTransfer $debitResponseTransfer
     *
     * @return string
     */
    protected function getState(DebitResponseTransfer $debitResponseTransfer): string
    {
        $status = $debitResponseTransfer->getBaseResponse()->getStatus();
        if ($status === static::DEBIT_APPROVED) {
            return CreditMemoConstants::STATE_COMPLETE;
        }

        return CreditMemoConstants::STATE_ERROR;
    }

    /**
     * @param \Generated\Shared\Transfer\DebitResponseTransfer $debitResponseTransfer
     *
     * @return bool
     */
    protected function wasSuccessfullyDebited(DebitResponseTransfer $debitResponseTransfer): bool
    {
        $state = $this->getState($debitResponseTransfer);
        if ($state === CreditMemoConstants::STATE_COMPLETE) {
            return true;
        }

        return false;
    }

    /**
     * @param \Generated\Shared\Transfer\DebitResponseTransfer $debitResponseTransfer
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     *
     * @return int
     */
    protected function getDebitedAmount(
        DebitResponseTransfer $debitResponseTransfer,
        RefundTransfer $refundTransfer
    ): int {
        if ($this->wasSuccessfullyDebited($debitResponseTransfer)) {
            return $refundTransfer->getAmount();
        }

        return 0;
    }

    /**
     * @param \Generated\Shared\Transfer\DebitResponseTransfer $debitResponseTransfer
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     *
     * @return int
     */
    protected function getDebitedTaxAmount(
        DebitResponseTransfer $debitResponseTransfer,
        RefundTransfer $refundTransfer
    ): int {
        if ($this->wasSuccessfullyDebited($debitResponseTransfer)) {
            return 0; //ToDo get or calculate tax
        }

        return 0;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoUpdateTransfer
     * @param \Generated\Shared\Transfer\DebitResponseTransfer $response
     *
     * @return void
     */
    protected function handleRefundError(
        CreditMemoTransfer $creditMemoUpdateTransfer,
        DebitResponseTransfer $response
    ): void {
        if ($this->wasSuccessfullyDebited($response) === false) {
            $creditMemoUpdateTransfer->setErrorCode($response->getBaseResponse()->getErrorCode());
            $creditMemoUpdateTransfer->setErrorMessage($response->getBaseResponse()->getErrorMessage());
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoUpdateTransfer
     * @param \Generated\Shared\Transfer\DebitResponseTransfer $response
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     *
     * @return void
     */
    protected function handleDebitResponse(
        CreditMemoTransfer $creditMemoUpdateTransfer,
        DebitResponseTransfer $response,
        RefundTransfer $refundTransfer
    ): void {
        $creditMemoUpdateTransfer->setState($this->getState($response))
            ->setWasRefundSuccessful($this->wasSuccessfullyDebited($response))
            ->setRefundedAmount($this->getDebitedAmount($response, $refundTransfer))
            ->setRefundedTaxAmount($this->getDebitedTaxAmount($response, $refundTransfer))
            ->setTransactionId($response->getTxid());

        $this->handleRefundError($creditMemoUpdateTransfer, $response);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    protected function prepareDebitRequest(
        OrderTransfer $orderTransfer,
        RefundTransfer $refundTransfer,
        FooCreditMemo $creditMemoEntity
    ): PayonePartialOperationRequestTransfer {
        $payonePartialOperationTransfer = (new PayonePartialOperationRequestTransfer())
            ->setOrder($orderTransfer)
            ->setRefund($refundTransfer);

        $payonePartialOperationTransfer = $this->executePreDebitPlugins($payonePartialOperationTransfer, $creditMemoEntity);

        return $payonePartialOperationTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoUpdateTransfer
     *
     * @return bool
     */
    protected function validateDebitAmounts(
        RefundTransfer $refundTransfer,
        FooCreditMemo $creditMemoEntity,
        CreditMemoTransfer $creditMemoUpdateTransfer
    ): bool {
        if ($refundTransfer->getAmount() === $creditMemoEntity->getTotalAmount()) {
            return true;
        }
        $creditMemoUpdateTransfer->setErrorMessage(sprintf('Calculated debit amount of %s is not the same as given amount of %s', $refundTransfer->getAmount(), $creditMemoEntity->getTotalAmount()));
        $creditMemoUpdateTransfer->setState(sprintf(CreditMemoConstants::STATE_ERROR));
        $this->updateCreditMemo($creditMemoEntity, $creditMemoUpdateTransfer);

        return false;
    }
}
