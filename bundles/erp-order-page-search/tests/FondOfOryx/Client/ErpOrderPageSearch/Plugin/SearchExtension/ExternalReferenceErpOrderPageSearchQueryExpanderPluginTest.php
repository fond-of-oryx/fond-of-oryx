<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Elastica\Query\MatchQuery;
use Elastica\Query\Terms;
use Exception;
use FondOfOryx\Shared\ErpOrderPageSearch\ErpOrderPageSearchConstants;
use Generated\Shared\Search\ErpOrderIndexMap;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class ExternalReferenceErpOrderPageSearchQueryExpanderPluginTest extends Unit
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
     * @var \FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension\ExternalReferenceErpOrderPageSearchQueryExpanderPlugin
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

        $this->requestParameters = [
            ErpOrderPageSearchConstants::PARAMETER_EXTERNAL_REFERENCE => [
                'EXTERNAL-FOO-BAR-1',
            ],
        ];

        $this->plugin = new ExternalReferenceErpOrderPageSearchQueryExpanderPlugin();
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

                        return isset($data['terms'][ErpOrderIndexMap::EXTERNAL_REFERENCE])
                            && $data['terms'][ErpOrderIndexMap::EXTERNAL_REFERENCE] === $self->requestParameters[ErpOrderPageSearchConstants::PARAMETER_EXTERNAL_REFERENCE];
                    },
                ),
            )->willReturn($this->boolQueryMock);

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

    /**
     * @return void
     */
    public function testExpandQueryWithInvalidRequestParameters(): void
    {
        $this->queryMock->expects(static::never())
            ->method('getSearchQuery');

        $query = $this->plugin->expandQuery(
            $this->queryMock,
            [
                ErpOrderPageSearchConstants::PARAMETER_EXTERNAL_REFERENCE => '',
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
            $this->plugin->expandQuery(
                $this->queryMock,
                $this->requestParameters,
            );

            static::fail();
        } catch (Exception $exception) {
        }
    }
}
