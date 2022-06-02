<?php

namespace FondOfOryx\Zed\PaymentCartConnector\Communication\Plugin\CartExtension;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\CartExtension\Dependency\Plugin\CartOperationPostSavePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class RemovePaymentCartOperationPostSavePlugin extends AbstractPlugin implements CartOperationPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function postSave(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $quoteTransfer->setPayment(null);
    }
}
