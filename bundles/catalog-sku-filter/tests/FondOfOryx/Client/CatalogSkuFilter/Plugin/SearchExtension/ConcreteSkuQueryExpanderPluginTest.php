<?php

namespace FondOfOryx\Client\CatalogSkuFilter\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchQuery;
use Elastica\Query\Terms;
use Exception;
use FondOfOryx\Shared\CatalogSkuFilter\CatalogSkuFilterConstants;
use Generated\Shared\Search\PageIndexMap;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class ConcreteSkuQueryExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected $queryMock;

    /**
     * @var array<array<\string>>
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
     * @var \FondOfOryx\Client\CatalogSkuFilter\Plugin\SearchExtension\ConcreteSkuQueryExpanderPlugin
     */
    protected $concreteSkuQueryExpanderPlugin;

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

        $this->requestParameters = [
            CatalogSkuFilterConstants::PARAMETER_CONCRETE_SKU => [
                'FOO-BAR-1-1',
                'FOO-BAR-1-2',
            ],
        ];

        $this->concreteSkuQueryExpanderPlugin = new ConcreteSkuQueryExpanderPlugin();
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
            ->method('addMust')
            ->with(
                static::callback(
                    static function (Terms $terms) use ($self) {
                        $data = $terms->toArray();

                        return isset($data['terms'][PageIndexMap::CONCRETE_SKUS])
                            && $data['terms'][PageIndexMap::CONCRETE_SKUS] === $self->requestParameters[CatalogSkuFilterConstants::PARAMETER_CONCRETE_SKU];
                    },
                ),
            )->willReturn($this->boolQueryMock);

        $query = $this->concreteSkuQueryExpanderPlugin->expandQuery(
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

        $query = $this->concreteSkuQueryExpanderPlugin->expandQuery(
            $this->queryMock,
            [],
        );

        static::assertEquals(
            $this->queryMock,
            $query,
        );
    }

    /**
     * @return void
     */
    public function testExpandQueryWithInvalidRequestParameters(): void
    {
        $this->queryMock->expects(static::never())
            ->method('getSearchQuery');

        $query = $this->concreteSkuQueryExpanderPlugin->expandQuery(
            $this->queryMock,
            [
                CatalogSkuFilterConstants::PARAMETER_CONCRETE_SKU => '',
            ],
        );

        static::assertEquals(
            $this->queryMock,
            $query,
        );
    }

    /**
     * @return void
     */
    public function testExpandQueryWithoutBoolQuery(): void
    {
        $this->queryMock->expects(static::atLeastOnce())
            ->method('getSearchQuery')
            ->willReturn($this->elasticaQueryMock);

        $this->elasticaQueryMock->expects(static::atLeastOnce())
            ->method('getQuery')
            ->willReturn($this->matchQueryMock);

        try {
            $this->concreteSkuQueryExpanderPlugin->expandQuery(
                $this->queryMock,
                $this->requestParameters,
            );

            static::fail();
        } catch (Exception $exception) {
        }
    }
}
