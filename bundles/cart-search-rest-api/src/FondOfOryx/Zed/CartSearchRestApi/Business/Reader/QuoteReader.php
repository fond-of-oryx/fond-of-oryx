<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Business\Reader;

use ArrayObject;
use FondOfOryx\Zed\CartSearchRestApi\Dependency\Facade\CartSearchRestApiToQuoteFacadeInterface;
use FondOfOryx\Zed\CartSearchRestApi\Persistence\CartSearchRestApiRepositoryInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QuoteCriteriaFilterTransfer;
use Generated\Shared\Transfer\QuoteListTransfer;

class QuoteReader implements QuoteReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Dependency\Facade\CartSearchRestApiToQuoteFacadeInterface
     */
    protected $quoteFacade;

    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Persistence\CartSearchRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @var array<\FondOfOryx\Zed\CartSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface>
     */
    protected $searchQuoteQueryExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\CartSearchRestApi\Dependency\Facade\CartSearchRestApiToQuoteFacadeInterface $quoteFacade
     * @param \FondOfOryx\Zed\CartSearchRestApi\Persistence\CartSearchRestApiRepositoryInterface $repository
     * @param array<\FondOfOryx\Zed\CartSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface> $searchQuoteQueryExpanderPlugins
     */
    public function __construct(
        CartSearchRestApiToQuoteFacadeInterface $quoteFacade,
        CartSearchRestApiRepositoryInterface $repository,
        array $searchQuoteQueryExpanderPlugins = []
    ) {
        $this->quoteFacade = $quoteFacade;
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
        $quoteListTransfer = $this->repository->findQuotes($quoteListTransfer);

        $idQuoteToIndex = [];
        $quoteTransfers = $quoteListTransfer->getQuotes();

        foreach ($quoteTransfers as $index => $quoteTransfer) {
            $idQuoteToIndex[$quoteTransfer->getIdQuote()] = $index;
        }

        if (count($idQuoteToIndex) === 0) {
            return $quoteListTransfer;
        }

        foreach ($this->findByQuoteIds(array_keys($idQuoteToIndex)) as $quoteTransfer) {
            $idQuote = $quoteTransfer->getIdQuote();

            if ($idQuote === null || !isset($idQuoteToIndex[$idQuote])) {
                continue;
            }

            $quoteTransfers->offsetSet($idQuoteToIndex[$idQuote], $quoteTransfer);
        }

        return $quoteListTransfer;
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

    /**
     * @param array<int> $quoteIds
     *
     * @return \ArrayObject<\Generated\Shared\Transfer\QuoteTransfer>
     */
    public function findByQuoteIds(array $quoteIds): ArrayObject
    {
        $quoteCriteriaFilterTransfer = (new QuoteCriteriaFilterTransfer())
            ->setQuoteIds($quoteIds);

        $quoteCollectionTransfer = $this->quoteFacade->getQuoteCollection($quoteCriteriaFilterTransfer);

        return $quoteCollectionTransfer->getQuotes();
    }
}
