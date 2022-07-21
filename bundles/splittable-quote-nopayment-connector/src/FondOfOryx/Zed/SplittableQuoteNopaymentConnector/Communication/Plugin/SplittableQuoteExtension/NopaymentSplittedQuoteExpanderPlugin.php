<?php

namespace FondOfOryx\Zed\SplittableQuoteNopaymentConnector\Communication\Plugin\SplittableQuoteExtension;

use FondOfOryx\Zed\SplittableQuoteExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Nopayment\NopaymentConfig;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class NopaymentSplittedQuoteExpanderPlugin extends AbstractPlugin implements SplittedQuoteExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $splittedQuoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $splittedQuoteTransfer): QuoteTransfer
    {
        $totalsTransfer = $splittedQuoteTransfer->getTotals();

        if ($totalsTransfer === null || $totalsTransfer->getPriceToPay() !== 0) {
            return $splittedQuoteTransfer;
        }

        $paymentTransfer = $splittedQuoteTransfer->getPayment();

        if ($paymentTransfer === null) {
            return $splittedQuoteTransfer;
        }

        $paymentTransfer->setPaymentSelection(NopaymentConfig::PAYMENT_METHOD_NAME)
            ->setPaymentProvider(NopaymentConfig::PAYMENT_PROVIDER_NAME)
            ->setPaymentMethod(NopaymentConfig::PAYMENT_METHOD_NAME);

        return $splittedQuoteTransfer;
    }
}
