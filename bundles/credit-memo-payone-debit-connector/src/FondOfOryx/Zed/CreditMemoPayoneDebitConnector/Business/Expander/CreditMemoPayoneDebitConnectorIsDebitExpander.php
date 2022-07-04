<?php

namespace FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Business\Expander;

use FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade\CreditMemoPayoneDebitConnectorToSalesFacadeInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;
use SprykerEco\Shared\Payone\PayoneApiConstants;

class CreditMemoPayoneDebitConnectorIsDebitExpander implements CreditMemoPayoneDebitConnectorIsDebitExpanderInterface
{
    /**
     * @var string
     */
    protected const STATE_PAID = 'paid';

    /**
     * @var string
     */
    protected const STATE_OVERPAID = 'overpaid';

    /**
     * @var string
     */
    protected const PAYMENT_PROVIDER = 'Payone';

    /**
     * @var \FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade\CreditMemoPayoneDebitConnectorToSalesFacadeInterface
     */
    protected $salesFacade;

    /**
     * @param \FondOfOryx\Zed\CreditMemoPayoneDebitConnector\Dependency\Facade\CreditMemoPayoneDebitConnectorToSalesFacadeInterface $salesFacade
     */
    public function __construct(CreditMemoPayoneDebitConnectorToSalesFacadeInterface $salesFacade)
    {
        $this->salesFacade = $salesFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return \Generated\Shared\Transfer\CreditMemoTransfer
     */
    public function expandCreditMemo(CreditMemoTransfer $creditMemoTransfer): CreditMemoTransfer
    {
        $isDebit = $this->isDebit($creditMemoTransfer);

        foreach ($creditMemoTransfer->getItems() as $item) {
            $item->setIsDebit($isDebit);
        }

        return $creditMemoTransfer->setIsDebit($isDebit);
    }

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return bool
     */
    protected function isDebit(CreditMemoTransfer $creditMemoTransfer): bool
    {
        $salesPaymentMethodType = $creditMemoTransfer->getSalesPaymentMethodType();

        if ($salesPaymentMethodType === null) {
            return false;
        }

        $distinctOrderStates = $this->salesFacade->getDistinctOrderStates($creditMemoTransfer->getFkSalesOrder());
        $paymentMethod = $salesPaymentMethodType->getPaymentMethod();
        $paymentProvider = $salesPaymentMethodType->getPaymentProvider();

        if ($paymentMethod === null || $paymentProvider === null) {
            return false;
        }

        $isStatusForDebit = !in_array(static::STATE_PAID, $distinctOrderStates, true) && !in_array(static::STATE_OVERPAID, $distinctOrderStates, true);
        $isPaymentMethodSecurityInvoice = $paymentMethod->getName() === PayoneApiConstants::PAYMENT_METHOD_SECURITY_INVOICE;
        $isPaymentProviderPayone = $paymentProvider->getName() === static::PAYMENT_PROVIDER;

        return $isStatusForDebit && $isPaymentMethodSecurityInvoice && $isPaymentProviderPayone;
    }
}
