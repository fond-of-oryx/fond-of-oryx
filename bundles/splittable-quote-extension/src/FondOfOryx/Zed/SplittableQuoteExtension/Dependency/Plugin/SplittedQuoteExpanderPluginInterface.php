<?php

namespace FondOfOryx\Zed\SplittableQuoteExtension\Dependency\Plugin;

use Generated\Shared\Transfer\QuoteTransfer;

interface SplittedQuoteExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $splittedQuoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expand(QuoteTransfer $splittedQuoteTransfer): QuoteTransfer;
}
