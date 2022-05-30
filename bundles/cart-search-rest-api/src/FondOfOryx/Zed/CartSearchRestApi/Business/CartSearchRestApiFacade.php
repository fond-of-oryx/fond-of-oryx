<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Business;

use Generated\Shared\Transfer\QuoteListTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CartSearchRestApi\Business\CartSearchRestApiBusinessFactory getFactory()
 */
class CartSearchRestApiFacade extends AbstractFacade implements CartSearchRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteListTransfer
     */
    public function findQuotes(QuoteListTransfer $quoteListTransfer): QuoteListTransfer
    {
        return $this->getFactory()
            ->createQuoteReader()
            ->findByQuoteList($quoteListTransfer);
    }
}
