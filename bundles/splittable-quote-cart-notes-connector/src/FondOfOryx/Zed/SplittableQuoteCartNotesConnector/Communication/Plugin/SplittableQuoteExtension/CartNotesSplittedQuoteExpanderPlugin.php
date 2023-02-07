<?php

namespace FondOfOryx\Zed\SplittableQuoteCartNotesConnector\Communication\Plugin\SplittableQuoteExtension;

use FondOfOryx\Zed\SplittableQuoteExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CartNotesSplittedQuoteExpanderPlugin extends AbstractPlugin implements SplittedQuoteExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $splittedQuoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $splittedQuoteTransfer): QuoteTransfer
    {
        $splitKey = $splittedQuoteTransfer->getSplitKey();
        $cartNotes = $splittedQuoteTransfer->getCartNotes();

        if (count($cartNotes) === 0) {
            return $splittedQuoteTransfer;
        }

        $cartNote = !isset($cartNotes[$splitKey]) ? null : $cartNotes[$splitKey];

        return $splittedQuoteTransfer->setCartNote($cartNote);
    }
}
