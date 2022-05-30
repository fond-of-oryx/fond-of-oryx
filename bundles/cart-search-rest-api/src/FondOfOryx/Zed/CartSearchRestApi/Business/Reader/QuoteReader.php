<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Business\Reader;

use FondOfOryx\Zed\CartSearchRestApi\Persistence\CartSearchRestApiRepositoryInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QuoteListTransfer;

class QuoteReader implements QuoteReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Persistence\CartSearchRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @var array<\FondOfOryx\Zed\CartSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface>
     */
    protected $searchQuoteQueryExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\CartSearchRestApi\Persistence\CartSearchRestApiRepositoryInterface $repository
     * @param array<\FondOfOryx\Zed\CartSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface> $searchQuoteQueryExpanderPlugins
     */
    public function __construct(
        CartSearchRestApiRepositoryInterface $repository,
        array $searchQuoteQueryExpanderPlugins = []
    ) {
        $this->repository = $repository;
        $this->searchQuoteQueryExpanderPlugins = $searchQuoteQueryExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteListTransfer
     */
    public function findByQuoteList(QuoteListTransfer $quoteListTransfer): QuoteListTransfer
    {
        $quoteListTransfer = $this->executeSearchQuoteQueryExpanderPlugins($quoteListTransfer);

        return $this->repository->findQuotes($quoteListTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteListTransfer
     */
    protected function executeSearchQuoteQueryExpanderPlugins(QuoteListTransfer $quoteListTransfer): QuoteListTransfer
    {
        $queryJoinCollectionTransfer = new QueryJoinCollectionTransfer();
        $filterTransfers = $quoteListTransfer->getFilterFields()->getArrayCopy();

        foreach ($this->searchQuoteQueryExpanderPlugins as $searchQuoteQueryExpanderPlugin) {
            if (!$searchQuoteQueryExpanderPlugin->isApplicable($filterTransfers)) {
                continue;
            }

            $queryJoinCollectionTransfer = $searchQuoteQueryExpanderPlugin->expand(
                $filterTransfers,
                $queryJoinCollectionTransfer,
            );
        }

        return $quoteListTransfer->setQueryJoins($queryJoinCollectionTransfer);
    }
}
