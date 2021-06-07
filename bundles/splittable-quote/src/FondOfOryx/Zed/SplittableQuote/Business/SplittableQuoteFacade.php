<?php

namespace FondOfOryx\Zed\SplittableQuote\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableQuote\Business\SplittableQuoteBusinessFactory getFactory()
 */
class SplittableQuoteFacade extends AbstractFacade implements SplittableQuoteFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, \Generated\Shared\Transfer\QuoteTransfer>
     */
    public function splitQuote(QuoteTransfer $quoteTransfer): array
    {
        return $this->getFactory()->createQuoteSplitter()->split($quoteTransfer);
    }
}
