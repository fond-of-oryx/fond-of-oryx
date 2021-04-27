<?php

namespace FondOfOryx\Zed\SplittableTotals\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SplittableTotalsTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\SplittableTotals\Business\SplittableTotalsBusinessFactory getFactory()
 */
class SplittableTotalsFacade extends AbstractFacade implements SplittableTotalsFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableTotalsTransfer
     */
    public function getSplittableTotalsByQuote(
        QuoteTransfer $quoteTransfer
    ): SplittableTotalsTransfer {
        return $this->getFactory()->createSplittableTotalsReader()
            ->getByQuote($quoteTransfer);
    }
}
