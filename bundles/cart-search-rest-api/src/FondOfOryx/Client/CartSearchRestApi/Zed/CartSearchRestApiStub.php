<?php

namespace FondOfOryx\Client\CartSearchRestApi\Zed;

use FondOfOryx\Client\CartSearchRestApi\Dependency\Client\CartSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\QuoteListTransfer;

class CartSearchRestApiStub implements CartSearchRestApiStubInterface
{
    /**
     * @var string
     */
    public const URL_FIND_QUOTES = '/cart-search-rest-api/gateway/find-quotes';

    /**
     * @var \FondOfOryx\Client\CartSearchRestApi\Dependency\Client\CartSearchRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\CartSearchRestApi\Dependency\Client\CartSearchRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CartSearchRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteListTransfer
     */
    public function findQuotes(QuoteListTransfer $quoteListTransfer): QuoteListTransfer
    {
        /** @var \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer */
        $quoteListTransfer = $this->zedRequestClient->call(static::URL_FIND_QUOTES, $quoteListTransfer);

        return $quoteListTransfer;
    }
}
