<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Generated\Shared\Transfer\PaymentProviderCollectionTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class SplittableCheckoutRestApiToPaymentFacadeBridge implements SplittableCheckoutRestApiToPaymentFacadeInterface
{
    /**
     * @var \Spryker\Zed\Payment\Business\PaymentFacadeInterface
     */
    protected $paymentFacade;

    /**
     * @param \Spryker\Zed\Payment\Business\PaymentFacadeInterface $paymentFacade
     */
    public function __construct($paymentFacade)
    {
        $this->paymentFacade = $paymentFacade;
    }

    /**
     * @return \Generated\Shared\Transfer\PaymentProviderCollectionTransfer
     */
    public function getAvailablePaymentProviders(): PaymentProviderCollectionTransfer
    {
        return $this->paymentFacade->getAvailablePaymentProviders();
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    public function getAvailableMethods(QuoteTransfer $quoteTransfer)
    {
        return $this->paymentFacade->getAvailableMethods($quoteTransfer);
    }
}
