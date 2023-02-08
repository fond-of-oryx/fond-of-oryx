<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApiCartNotesConnector\Plugin\SplittableCheckoutRestApiExtension;

use FondOfOryx\Glue\SplittableCheckoutRestApiExtension\Dependency\Plugin\RestSplittableCheckoutExpanderPluginInterface;
use Generated\Shared\Transfer\RestSplittableCheckoutTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;
use Spryker\Glue\Kernel\AbstractPlugin;

class CartNotesRestSplittableCheckoutExpanderPlugin extends AbstractPlugin implements RestSplittableCheckoutExpanderPluginInterface
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
        $cartNotes = [];

        foreach ($splittableCheckoutTransfer->getSplittedQuotes() as $splittedQuote) {
            $cartNote = $splittedQuote->getCartNote();
            $splitKey = $splittedQuote->getSplitKey();

            if ($splitKey === null || $cartNote === null) {
                continue;
            }

            $cartNotes[$splitKey] = $cartNote;
        }

        if (count($cartNotes) === 0) {
            return $restSplittableCheckoutTransfer;
        }

        return $restSplittableCheckoutTransfer->setCartNotes($cartNotes);
    }
}
