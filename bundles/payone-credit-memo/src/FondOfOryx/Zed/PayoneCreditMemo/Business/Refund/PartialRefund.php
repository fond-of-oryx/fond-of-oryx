<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Business\Refund;

use Exception;
use FondOfOryx\Shared\CreditMemo\CreditMemoConstants;
use FondOfOryx\Shared\CreditMemo\CreditMemoRefundHelperTrait;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToPayoneInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToRefundInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToSalesInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\PayonePartialOperationRequestTransfer;
use Generated\Shared\Transfer\RefundResponseTransfer;
use Generated\Shared\Transfer\RefundTransfer;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Orm\Zed\Sales\Persistence\SpySalesOrder;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;

class PartialRefund implements PartialRefundInterface
{
    use CreditMemoRefundHelperTrait;

    /**
     * @var string
     */
    public const REFUND_APPROVED = 'APPROVED';

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
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var array<\FondOfOryx\Zed\PayoneCreditMemoExtension\Dependency\Plugin\PayoneCreditMemoPreRefundPluginInterface>
     */
    protected $preRefundPlugins;

    /**
     * @param \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToCreditMemoInterface $creditMemoFacade
     * @param \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToRefundInterface $refundFacade
     * @param \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToSalesInterface $salesFacade
     * @param \FondOfOryx\Zed\PayoneCreditMemo\Dependency\Facade\PayoneCreditMemoToPayoneInterface $payoneFacade
     * @param \Psr\Log\LoggerInterface $logger
     * @param array<\FondOfOryx\Zed\PayoneCreditMemoExtension\Dependency\Plugin\PayoneCreditMemoPreRefundPluginInterface> $preRefundPlugins
     */
    public function __construct(
        PayoneCreditMemoToCreditMemoInterface $creditMemoFacade,
        PayoneCreditMemoToRefundInterface $refundFacade,
        PayoneCreditMemoToSalesInterface $salesFacade,
        PayoneCreditMemoToPayoneInterface $payoneFacade,
        LoggerInterface $logger,
        array $preRefundPlugins
    ) {
        $this->creditMemoFacade = $creditMemoFacade;
        $this->refundFacade = $refundFacade;
        $this->salesFacade = $salesFacade;
        $this->payoneFacade = $payoneFacade;
        $this->logger = $logger;
        $this->preRefundPlugins = $preRefundPlugins;
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
    public function executePartialRefund(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data): array
    {
        $creditMemos = $this->creditMemoFacade->getCreditMemosBySalesOrderItems($orderItems);
        $creditMemos = $this->resolveAndPrepareCreditMemos($creditMemos);

        $refundItems = $this->resolveRefundableItems($creditMemos, $orderItems);

        $results = [];
        foreach ($creditMemos as $creditMemoReference => $creditMemoEntity) {
            $creditMemoUpdateTransfer = $this->prepareCreditMemoUpdateTransfer();
            $results[$creditMemoReference] = $creditMemoUpdateTransfer->getInProgress();
            if (array_key_exists($creditMemoReference, $refundItems)) {
                $itemsToRefund = $this->resolveAndCheckItemsForRefund($refundItems[$creditMemoReference]);
                $refundTransfer = $this->refundFacade->calculateRefund($itemsToRefund, $orderEntity);

                if ($this->validateRefundAmounts($refundTransfer, $creditMemoEntity, $creditMemoUpdateTransfer) === false) {
                    continue;
                }

                if ($this->isRefundableAmount($refundTransfer)) {
                    $orderTransfer = $this->salesFacade->getOrderByIdSalesOrder($orderEntity->getIdSalesOrder());

                    $payonePartialOperationTransfer = $this->prepareRefundRequest($orderTransfer, $refundTransfer, $creditMemoEntity);

                    foreach ($orderItems as $orderItem) {
                        $payonePartialOperationTransfer->addSalesOrderItemId($orderItem->getIdSalesOrderItem());
                    }

                    $response = $this->payoneFacade->executePartialRefund($payonePartialOperationTransfer);
                    $results[$creditMemoReference] = $response;
                    $this->handleRefundResponse($creditMemoUpdateTransfer, $response, $refundTransfer);

                    if ($creditMemoUpdateTransfer->getWasRefundSuccessful() === true) {
                        try {
                            $this->refundFacade->saveRefund($refundTransfer);
                        } catch (Exception $exception) {
                            $this->logger->error($exception->getMessage(), $exception->getTrace());

                            throw $exception;
                        }
                    } else {
                        $this->logger->error(sprintf(
                            'Order %s: %s',
                            $orderTransfer->getIdSalesOrder(),
                            $creditMemoUpdateTransfer->getErrorMessage(),
                        ), [$creditMemoUpdateTransfer->getOrderReference()]);
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
    protected function resolveRefundableItems(array $creditMemos, array $orderItems): array
    {
        $refundItems = [];
        foreach ($creditMemos as $creditMemoEntity) {
            $refundItems = array_merge(
                $refundItems,
                $this->getRefundableItemsByCreditMemo($creditMemoEntity, $orderItems),
            );
        }

        return $refundItems;
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
    protected function executePreRefundPlugins(
        PayonePartialOperationRequestTransfer $partialOperationRequestTransfer,
        FooCreditMemo $creditMemoEntity
    ): PayonePartialOperationRequestTransfer {
        foreach ($this->preRefundPlugins as $preRefundPlugin) {
            $partialOperationRequestTransfer = $preRefundPlugin->execute($partialOperationRequestTransfer, $creditMemoEntity);
        }

        return $partialOperationRequestTransfer;
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
    protected function handleRefundError(
        CreditMemoTransfer $creditMemoUpdateTransfer,
        RefundResponseTransfer $response
    ): void {
        if ($this->wasSuccessfullyRefunded($response) === false) {
            $creditMemoUpdateTransfer->setErrorCode($response->getBaseResponse()->getErrorCode());
            $creditMemoUpdateTransfer->setErrorMessage($response->getBaseResponse()->getErrorMessage());
        }
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

        $this->handleRefundError($creditMemoUpdateTransfer, $response);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     *
     * @return \Generated\Shared\Transfer\PayonePartialOperationRequestTransfer
     */
    protected function prepareRefundRequest(
        OrderTransfer $orderTransfer,
        RefundTransfer $refundTransfer,
        FooCreditMemo $creditMemoEntity
    ): PayonePartialOperationRequestTransfer {
        $payonePartialOperationTransfer = (new PayonePartialOperationRequestTransfer())
            ->setOrder($orderTransfer)
            ->setRefund($refundTransfer);

        $payonePartialOperationTransfer = $this->executePreRefundPlugins($payonePartialOperationTransfer, $creditMemoEntity);

        return $payonePartialOperationTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\RefundTransfer $refundTransfer
     * @param \Orm\Zed\CreditMemo\Persistence\FooCreditMemo $creditMemoEntity
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoUpdateTransfer
     *
     * @return bool
     */
    protected function validateRefundAmounts(
        RefundTransfer $refundTransfer,
        FooCreditMemo $creditMemoEntity,
        CreditMemoTransfer $creditMemoUpdateTransfer
    ): bool {
        if ($refundTransfer->getAmount() === $creditMemoEntity->getTotalAmount()) {
            return true;
        }
        $creditMemoUpdateTransfer->setErrorMessage(sprintf('Calculated refund amount of %s is not the same as given amount of %s', $refundTransfer->getAmount(), $creditMemoEntity->getTotalAmount()));
        $creditMemoUpdateTransfer->setState(sprintf(CreditMemoConstants::STATE_ERROR));
        $this->updateCreditMemo($creditMemoEntity, $creditMemoUpdateTransfer);

        return false;
    }
}
