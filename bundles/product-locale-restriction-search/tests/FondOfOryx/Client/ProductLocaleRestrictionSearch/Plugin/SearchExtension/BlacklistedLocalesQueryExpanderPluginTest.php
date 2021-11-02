<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionSearch\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchQuery;
use Elastica\Query\Term;
use Exception;
use FondOfOryx\Client\ProductLocaleRestrictionSearch\Dependency\Client\ProductLocaleRestrictionSearchToLocaleClientInterface;
use FondOfOryx\Client\ProductLocaleRestrictionSearch\ProductLocaleRestrictionSearchFactory;
use Generated\Shared\Search\PageIndexMap;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class BlacklistedLocalesQueryExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionSearch\ProductLocaleRestrictionSearchFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productLocaleRestrictionSearchFactoryMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionSearch\Dependency\Client\ProductLocaleRestrictionSearchToLocaleClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected $queryMock;

    /**
     * @var \Elastica\Query|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $elasticaQueryMock;

    /**
     * @var \Elastica\Query\BoolQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $boolQueryMock;

    /**
     * @var \Elastica\Query\MatchQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $matchQueryMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionSearch\Plugin\SearchExtension\BlacklistedLocalesQueryExpanderPlugin
     */
    protected $blacklistedLocalesQueryExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productLocaleRestrictionSearchFactoryMock = $this->getMockBuilder(ProductLocaleRestrictionSearchFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeClientMock = $this->getMockBuilder(ProductLocaleRestrictionSearchToLocaleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->elasticaQueryMock = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->boolQueryMock = $this->getMockBuilder(BoolQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->matchQueryMock = $this->getMockBuilder(MatchQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->blacklistedLocalesQueryExpanderPlugin = new BlacklistedLocalesQueryExpanderPlugin();
        $this->blacklistedLocalesQueryExpanderPlugin->setFactory($this->productLocaleRestrictionSearchFactoryMock);
    }

    /**
     * @return void
     */
    public function testExpandQuery(): void
    {
        $currentLocale = 'de_DE';

        $this->productLocaleRestrictionSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getLocaleClient')
            ->willReturn($this->localeClientMock);

        $this->localeClientMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($currentLocale);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->elasticaQueryMock);

        $this->elasticaQueryMock->expects(static::atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->boolQueryMock);

        $this->boolQueryMock->expects(static::atLeastOnce())
            ->method('addMustNot')
            ->with(
                static::callback(
                    static function (Term $term) use ($currentLocale) {
                        $data = $term->toArray();

                        return isset($data['term'][PageIndexMap::BLACKLISTED_LOCALES])
                            && $data['term'][PageIndexMap::BLACKLISTED_LOCALES]['value'] === $currentLocale;
                    },
                ),
            )->willReturn($this->boolQueryMock);

        static::assertEquals(
            $this->queryMock,
            $this->blacklistedLocalesQueryExpanderPlugin->expandQuery($this->queryMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandQueryWithoutBoolQuery(): void
    {
        $currentLocale = 'de_DE';

        $this->productLocaleRestrictionSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getLocaleClient')
            ->willReturn($this->localeClientMock);

        $this->localeClientMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($currentLocale);

        $this->queryMock->expects(static::atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->elasticaQueryMock);

        $this->elasticaQueryMock->expects(static::atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->matchQueryMock);

        try {
            $this->blacklistedLocalesQueryExpanderPlugin->expandQuery($this->queryMock);

            static::fail();
        } catch (Exception $exception) {
        }
    }
}
