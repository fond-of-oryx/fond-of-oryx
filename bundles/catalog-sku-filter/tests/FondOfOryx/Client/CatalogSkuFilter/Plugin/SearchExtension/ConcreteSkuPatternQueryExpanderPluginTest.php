<?php

namespace FondOfOryx\Client\CatalogSkuFilter\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchQuery;
use Elastica\Query\Wildcard;
use Exception;
use FondOfOryx\Shared\CatalogSkuFilter\CatalogSkuFilterConstants;
use Generated\Shared\Search\PageIndexMap;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class ConcreteSkuPatternQueryExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected $queryMock;

    /**
     * @var array<string>
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
     * @var \FondOfOryx\Client\CatalogSkuFilter\Plugin\SearchExtension\ConcreteSkuPatternQueryExpanderPlugin
     */
    protected $concreteSkuPatternQueryExpanderPlugin;

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
            CatalogSkuFilterConstants::PARAMETER_CONCRETE_SKU_PATTERN => '*FOO-BAR*',
        ];

        $this->concreteSkuPatternQueryExpanderPlugin = new ConcreteSkuPatternQueryExpanderPlugin();
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
                    static function (Wildcard $wildcard) use ($self) {
                        $data = $wildcard->toArray();

                        return isset($data['wildcard'][PageIndexMap::CONCRETE_SKUS]['value'])
                            && $data['wildcard'][PageIndexMap::CONCRETE_SKUS]['value'] === $self->requestParameters[CatalogSkuFilterConstants::PARAMETER_CONCRETE_SKU_PATTERN];
                    },
                ),
            )->willReturn($this->boolQueryMock);

        $query = $this->concreteSkuPatternQueryExpanderPlugin->expandQuery(
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

        $query = $this->concreteSkuPatternQueryExpanderPlugin->expandQuery(
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

        $query = $this->concreteSkuPatternQueryExpanderPlugin->expandQuery(
            $this->queryMock,
            [
                CatalogSkuFilterConstants::PARAMETER_CONCRETE_SKU_PATTERN => '',
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
            $this->concreteSkuPatternQueryExpanderPlugin->expandQuery(
                $this->queryMock,
                $this->requestParameters,
            );

            static::fail();
        } catch (Exception $exception) {
        }
    }
}
