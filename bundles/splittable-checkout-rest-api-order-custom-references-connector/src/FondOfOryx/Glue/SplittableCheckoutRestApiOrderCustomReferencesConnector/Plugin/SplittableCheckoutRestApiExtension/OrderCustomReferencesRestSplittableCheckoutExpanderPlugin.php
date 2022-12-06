<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApiOrderCustomReferencesConnector\Plugin\SplittableCheckoutRestApiExtension;

use FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\RestSplittableCheckoutExpanderPluginInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;
use Spryker\Glue\Kernel\AbstractPlugin;

class OrderCustomReferencesRestSplittableCheckoutExpanderPlugin extends AbstractPlugin implements RestSplittableCheckoutExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\SplittableCheckoutTransfer $splittableCheckoutTransfer
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutTransfer $restSplittableCheckoutTransfer
     *
     * @return \Generated\Shared\Transfer\RestSplittableCheckoutTransfer
     */
    public function expand(
        SplittableCheckoutTransfer $splittableCheckoutTransfer,
        RestSplittableCheckoutTransfer $restSplittableCheckoutTransfer
    ): RestSplittableCheckoutTransfer {
        $orderCustomReferences = [];

        foreach ($splittableCheckoutTransfer->getSplittedQuotes() as $splittedQuote) {
            $orderCustomReference = $splittedQuote->getOrderCustomReference();
            $splitKey = $splittedQuote->getSplitKey();

            if ($splitKey === null || $orderCustomReference === null) {
                continue;
            }

            $orderCustomReferences[$splitKey] = $orderCustomReference;
        }

        if (count($orderCustomReferences) === 0) {
            return $restSplittableCheckoutTransfer;
        }

        return $restSplittableCheckoutTransfer->setOrderCustomReferences($orderCustomReferences);
    }
}
