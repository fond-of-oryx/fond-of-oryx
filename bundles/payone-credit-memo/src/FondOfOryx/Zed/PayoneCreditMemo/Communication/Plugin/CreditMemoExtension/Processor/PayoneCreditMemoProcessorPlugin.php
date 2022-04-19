<?php

namespace FondOfOryx\Zed\PayoneCreditMemo\Communication\Plugin\CreditMemoExtension\Processor;

use Exception;
use FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface;
use FondOfOryx\Zed\PayoneCreditMemo\Exception\NoRefundableItemsFoundException;
use Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\PayoneCreditMemo\Business\PayoneCreditMemoFacade getFacade()
 * @method \FondOfOryx\Zed\PayoneCreditMemo\PayoneCreditMemoConfig getConfig()
 * @method \FondOfOryx\Zed\PayoneCreditMemo\Communication\PayoneCreditMemoCommunicationFactory getFactory()
 */
class PayoneCreditMemoProcessorPlugin extends AbstractPlugin implements CreditMemoProcessorPluginInterface
{
    use LoggerTrait;

    /**
     * @var string
     */
    public const NAME = 'PayoneCreditMemoProcessorPlugin';

    /**
     * @var string
     */
    public const LISTENING_PAYMENT_PROVIDER = 'Payone';

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
            && $salesPaymentMethodType->getPaymentProvider() !== null
            && $salesPaymentMethodType->getPaymentProvider()->getName() === static::LISTENING_PAYMENT_PROVIDER
            && $salesPaymentMethodType->getPaymentMethod() !== null
            && in_array($salesPaymentMethodType->getPaymentMethod()->getName(), $this->getConfig()->getListeningPaymentMethods(), true);
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @throws \FondOfOryx\Zed\PayoneCreditMemo\Exception\NoRefundableItemsFoundException
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
