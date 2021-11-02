<?php

namespace FondOfOryx\Zed\PrepaymentCreditMemo\Communication\Plugin\CreditMemoExtension\Processor;

use Exception;
use FondOfOryx\Zed\CreditMemo\Exception\NoRefundableItemsFoundException;
use FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface;
use Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\Business\PrepaymentCreditMemoFacade getFacade()
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\PrepaymentCreditMemoConfig getConfig()
 * @method \FondOfOryx\Zed\PrepaymentCreditMemo\Communication\PrepaymentCreditMemoCommunicationFactory getFactory()
 */
class PrepaymentCreditMemoProcessorPlugin extends AbstractPlugin implements CreditMemoProcessorPluginInterface
{
    use LoggerTrait;

    /**
     * @var string
     */
    public const NAME = 'PrepaymentCreditMemoProcessorPlugin';

    /**
     * @var string
     */
    public const LISTENING_PAYMENT_PROVIDER = 'Prepayment';

    /**
     * @var string
     */
    public const LISTENING_PAYMENT_METHOD = 'prepayment';

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     * @param \Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer $statusResponse
     *
     * @return \Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer|null
     */
    public function process(
        CreditMemoTransfer $creditMemoTransfer,
        CreditMemoProcessorStatusTransfer $statusResponse
    ): ?CreditMemoProcessorStatusTransfer {
        if ($this->canProcess($creditMemoTransfer) === true) {
            try {
                $items = $this->resolveItemsToRefund($creditMemoTransfer);
                $status = $this->getFactory()->getOmsFacade()->triggerEvent(
                    CreditMemoProcessorPluginInterface::EVENT_NAME,
                    $items,
                    [],
                );
                $statusResponse->setMessage('internal oms failure');

                if ($status !== null) {
                    $statusResponse->setMessage('');
                    $statusResponse->setSuccess(true);
                }
            } catch (Exception $exception) {
                $statusResponse->setMessage($exception->getMessage());
                $statusResponse->setSuccess(false);
                $this->getLogger()->error($exception->getMessage(), $exception->getTrace());
            }
        }

        return $statusResponse;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return static::NAME;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return bool
     */
    public function canProcess(CreditMemoTransfer $creditMemoTransfer): bool
    {
        $salesPaymentMethodType = $creditMemoTransfer->getSalesPaymentMethodType();

        return $salesPaymentMethodType !== null
            && $salesPaymentMethodType->getPaymentMethod() !== null
            && $salesPaymentMethodType->getPaymentMethod()->getName() === static::LISTENING_PAYMENT_METHOD
            && $salesPaymentMethodType->getPaymentProvider() !== null
            && $salesPaymentMethodType->getPaymentProvider()->getName() === static::LISTENING_PAYMENT_PROVIDER;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @throws \FondOfOryx\Zed\CreditMemo\Exception\NoRefundableItemsFoundException
     *
     * @return \Propel\Runtime\Collection\ObjectCollection
     */
    protected function resolveItemsToRefund(CreditMemoTransfer $creditMemoTransfer): ObjectCollection
    {
        $items = $this->getFactory()->getCreditMemoFacade()->getSalesOrderItemsByCreditMemo($creditMemoTransfer);

        if ($items === null) {
            throw new NoRefundableItemsFoundException(sprintf(
                'No refundable items found for CreditMemo with id %s and order reference %s',
                $creditMemoTransfer->getIdCreditMemo(),
                $creditMemoTransfer->getOrderReference(),
            ));
        }

        return $items;
    }
}
