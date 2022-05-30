<?php

namespace FondOfOryx\Client\CartSearchRestApi;

use Generated\Shared\Transfer\QuoteListTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\CartSearchRestApi\CartSearchRestApiFactory getFactory()
 */
class CartSearchRestApiClient extends AbstractClient implements CartSearchRestApiClientInterface
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
        return $this->getFactory()->createZedCartSearchRestApiStub()->findQuotes($quoteListTransfer);
    }
}
