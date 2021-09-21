<?php

namespace FondOfOryx\Zed\DeliveryDateRestriction\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\DeliveryDateRestriction\Business\DeliveryDateRestrictionBusinessFactory getFactory()
 */
class DeliveryDateRestrictionFacade extends AbstractFacade implements DeliveryDateRestrictionFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function expandQuote(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return $this->getFactory()
            ->createQuoteExpander()
            ->expand($quoteTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function validateQuote(QuoteTransfer $quoteTransfer): void
    {
        $this->getFactory()
            ->createQuoteValidator()
            ->validate($quoteTransfer);
    }
}
