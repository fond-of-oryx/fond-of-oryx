<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\QuoteListTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CartSearchRestApi\Persistence\CartSearchRestApiPersistenceFactory getFactory()
 */
class CartSearchRestApiRepository extends AbstractRepository implements CartSearchRestApiRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteListTransfer
     */
    public function findQuotes(QuoteListTransfer $quoteListTransfer): QuoteListTransfer
    {
        $query = $this->getFactory()
            ->getQuoteQuery()
            ->clear()
            ->groupByIdQuote()
            ->setIgnoreCase(true);

        $query = $this->getFactory()
            ->createQuoteSearchFilterFieldQueryBuilder()
            ->addQueryFilters($query, $quoteListTransfer);

        $queryJoinCollectionTransfer = $quoteListTransfer->getQueryJoins();

        if ($queryJoinCollectionTransfer !== null && $queryJoinCollectionTransfer->getQueryJoins()->count() > 0) {
            $query = $this->getFactory()
                ->createQuoteQueryJoinQueryBuilder()
                ->addQueryFilters($query, $queryJoinCollectionTransfer);
        }

        $quoteTransfers = $this->getFactory()
            ->createQuoteMapper()
            ->mapEntityCollectionToTransfers($query->find());

        return $quoteListTransfer->setQuotes(new ArrayObject($quoteTransfers));
    }
}
