<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiOrderCustomReferencesConnector\Communication\Plugin\SplittableCheckoutRestApiExtension;

use FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class OrderCustomReferencesQuoteExpanderPlugin extends AbstractPlugin implements QuoteExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer,
        QuoteTransfer $quoteTransfer
    ): QuoteTransfer {
        $orderCustomReferences = $restSplittableCheckoutRequestTransfer->getOrderCustomReferences();

        return $quoteTransfer->setOrderCustomReferences($orderCustomReferences);
    }
}
