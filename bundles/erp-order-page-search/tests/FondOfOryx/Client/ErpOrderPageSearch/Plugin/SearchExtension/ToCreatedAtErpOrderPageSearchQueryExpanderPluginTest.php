<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchQuery;
use FondOfOryx\Shared\ErpOrderPageSearch\ErpOrderPageSearchConstants;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class ToCreatedAtErpOrderPageSearchQueryExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected $queryMock;

    /**
     * @var array<array<string>>
     */
    protected $requestParameters;

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
     * @var \Spryker\Client\SearchExtension\Dependency\Plugin\QueryExpanderPluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

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

        $this->requestParameters = [ /** @phpstan-ignore-line */
            ErpOrderPageSearchConstants::PARAMETER_TO => '1970-01-01',
        ];

        $this->plugin = new ToCreatedAtDateErpOrderPageSearchQueryExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpandQuery(): void
    {
        $self = $this;

        $this->queryMock->expects(static::atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->elasticaQueryMock);

        $this->elasticaQueryMock->expects(static::atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->boolQueryMock);

        $this->boolQueryMock->expects(static::atLeastOnce())
            ->method('addFilter')
            ->willReturn($this->boolQueryMock);

        $query = $this->plugin->expandQuery(
            $this->queryMock,
            $this->requestParameters,
        );

        static::assertEquals(
            $this->queryMock,
            $query,
        );
    }

    /**
     * @return void
     */
    public function testExpandQueryWithoutRequiredRequestParameters(): void
    {
        $this->queryMock->expects(static::never())
            ->method('getSearchQuery');

        $query = $this->plugin->expandQuery(
            $this->queryMock,
            [],
        );

        static::assertEquals(
            $this->queryMock,
            $query,
        );
    }
}
