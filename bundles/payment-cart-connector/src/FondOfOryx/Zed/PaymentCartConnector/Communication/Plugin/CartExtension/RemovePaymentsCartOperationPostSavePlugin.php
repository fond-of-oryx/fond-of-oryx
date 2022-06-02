<?php

namespace FondOfOryx\Zed\PaymentCartConnector\Communication\Plugin\CartExtension;

use ArrayObject;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\CartExtension\Dependency\Plugin\CartOperationPostSavePluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class RemovePaymentsCartOperationPostSavePlugin extends AbstractPlugin implements CartOperationPostSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function postSave(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $quoteTransfer->setPayments(new ArrayObject());
    }
}
