<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Persistence;

use FondOfOryx\Zed\CartSearchRestApi\CartSearchRestApiDependencyProvider;
use FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\Mapper\QuoteMapper;
use FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\Mapper\QuoteMapperInterface;
use FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\QueryBuilder\QuoteQueryJoinQueryBuilder;
use FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\QueryBuilder\QuoteQueryJoinQueryBuilderInterface;
use FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\QueryBuilder\QuoteSearchFilterFieldQueryBuilder;
use FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\QueryBuilder\QuoteSearchFilterFieldQueryBuilderInterface;
use Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery;
use Spryker\Zed\Kernel\Persistence\AbstractPersistenceFactory;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CartSearchRestApi\CartSearchRestApiConfig getConfig()
 */
class CartSearchRestApiPersistenceFactory extends AbstractPersistenceFactory
{
    /**
     * @return \Orm\Zed\Quote\Persistence\Base\SpyQuoteQuery
     */
    public function getQuoteQuery(): SpyQuoteQuery
    {
        return $this->getProvidedDependency(CartSearchRestApiDependencyProvider::PROPEL_QUERY_QUOTE);
    }

    /**
     * @return \FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\QueryBuilder\QuoteQueryJoinQueryBuilderInterface
     */
    public function createQuoteQueryJoinQueryBuilder(): QuoteQueryJoinQueryBuilderInterface
    {
        return new QuoteQueryJoinQueryBuilder();
    }

    /**
     * @return \FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\QueryBuilder\QuoteSearchFilterFieldQueryBuilderInterface
     */
    public function createQuoteSearchFilterFieldQueryBuilder(): QuoteSearchFilterFieldQueryBuilderInterface
    {
        return new QuoteSearchFilterFieldQueryBuilder(
            $this->getConfig(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CartSearchRestApi\Persistence\Propel\Mapper\QuoteMapperInterface
     */
    public function createQuoteMapper(): QuoteMapperInterface
    {
        return new QuoteMapper();
    }
}
