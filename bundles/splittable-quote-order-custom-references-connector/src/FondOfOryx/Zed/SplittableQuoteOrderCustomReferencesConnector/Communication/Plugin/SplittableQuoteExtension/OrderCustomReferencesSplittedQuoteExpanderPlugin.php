<?php

namespace FondOfOryx\Zed\SplittableQuoteOrderCustomReferencesConnector\Communication\Plugin\SplittableQuoteExtension;

use FondOfOryx\Zed\SplittableQuoteExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class OrderCustomReferencesSplittedQuoteExpanderPlugin extends AbstractPlugin implements SplittedQuoteExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $splittedQuoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $splittedQuoteTransfer): QuoteTransfer
    {
        $splitKey = $splittedQuoteTransfer->getSplitKey();
        $orderCustomReferences = $splittedQuoteTransfer->getOrderCustomReferences();

        if (count($orderCustomReferences) === 0) {
            return $splittedQuoteTransfer;
        }

        $orderCustomReference = !isset($orderCustomReferences[$splitKey]) ? null : $orderCustomReferences[$splitKey];

        return $splittedQuoteTransfer->setOrderCustomReference($orderCustomReference);
    }
}
