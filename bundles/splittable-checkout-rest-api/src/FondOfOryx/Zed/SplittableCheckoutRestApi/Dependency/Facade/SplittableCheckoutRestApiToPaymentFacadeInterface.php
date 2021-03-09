<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Dependency\Facade;

use Generated\Shared\Transfer\PaymentProviderCollectionTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface SplittableCheckoutRestApiToPaymentFacadeInterface
{
    /**
     * @return \Generated\Shared\Transfer\PaymentProviderCollectionTransfer
     */
    public function getAvailablePaymentProviders(): PaymentProviderCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\PaymentMethodsTransfer
     */
    public function getAvailableMethods(QuoteTransfer $quoteTransfer);
}
