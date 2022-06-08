<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence;

use ArrayObject;
use Generated\Shared\Transfer\QuoteListTransfer;
use Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery;
use Propel\Runtime\ActiveQuery\ModelCriteria;
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

        $query = $this->preparePagination($query, $quoteListTransfer);

        $quoteTransfers = $this->getFactory()
            ->createQuoteMapper()
            ->mapEntityCollectionToTransfers($query->find());

        return $quoteListTransfer->setQuotes(new ArrayObject($quoteTransfers));
    }

    /**
     * @param \Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery $query
     * @param \Generated\Shared\Transfer\QuoteListTransfer $quoteListTransfer
     *
     * @return \Propel\Runtime\ActiveQuery\ModelCriteria
     */
    protected function preparePagination(
        SpyQuoteQuery $query,
        QuoteListTransfer $quoteListTransfer
    ): ModelCriteria {
        $config = $this->getFactory()->getConfig();
        $itemsPerPage = $config->getItemsPerPage();
        $validItemsPerPageOptions = $config->getValidItemsPerPageOptions();
        $paginationTransfer = $quoteListTransfer->requirePagination()->getPagination();
        $page = $paginationTransfer->getPage() ?? 1;
        $maxPerPage = $paginationTransfer->getMaxPerPage();

        if ($maxPerPage === null || !in_array($maxPerPage, $validItemsPerPageOptions, true)) {
            $maxPerPage = $itemsPerPage;
        }

        $propelModelPager = $query->paginate($page, $maxPerPage);

        $paginationTransfer->setNbResults($propelModelPager->getNbResults())
            ->setFirstIndex($propelModelPager->getFirstIndex())
            ->setLastIndex($propelModelPager->getLastIndex())
            ->setFirstPage($propelModelPager->getFirstPage())
            ->setLastPage($propelModelPager->getLastPage())
            ->setNextPage($propelModelPager->getNextPage())
            ->setPreviousPage($propelModelPager->getPreviousPage());

        return $propelModelPager->getQuery();
    }
}
