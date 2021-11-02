<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionSearch\Plugin\SearchExtension;

use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\Term;
use Generated\Shared\Search\PageIndexMap;
use InvalidArgumentException;
use Spryker\Client\Kernel\AbstractPlugin;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

/**
 * @method \FondOfOryx\Client\ProductLocaleRestrictionSearch\ProductLocaleRestrictionSearchFactory getFactory()
 */
class BlacklistedLocalesQueryExpanderPlugin extends AbstractPlugin implements QueryExpanderPluginInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface $searchQuery
     * @param array $requestParameters
     *
     * @return \Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    public function expandQuery(QueryInterface $searchQuery, array $requestParameters = []): QueryInterface
    {
        $currentLocale = $this->getFactory()->getLocaleClient()->getCurrentLocale();

        $blacklistedLocalesTerm = (new Term())->setTerm(
            PageIndexMap::BLACKLISTED_LOCALES,
            $currentLocale,
        );

        $this->getBoolQuery($searchQuery->getSearchQuery())
            ->addMustNot($blacklistedLocalesTerm);

        return $searchQuery;
    }

    /**
     * @param \Elastica\Query $query
     *
     * @throws \InvalidArgumentException
     *
     * @return \Elastica\Query\BoolQuery
     */
    protected function getBoolQuery(Query $query): BoolQuery
    {
        $boolQuery = $query->getQuery();

        if (!$boolQuery instanceof BoolQuery) {
            throw new InvalidArgumentException(
                sprintf(
                    'Blacklisted locales query expander available only with %s, got: %s',
                    BoolQuery::class,
                    get_class($boolQuery),
                ),
            );
        }

        return $boolQuery;
    }
}
