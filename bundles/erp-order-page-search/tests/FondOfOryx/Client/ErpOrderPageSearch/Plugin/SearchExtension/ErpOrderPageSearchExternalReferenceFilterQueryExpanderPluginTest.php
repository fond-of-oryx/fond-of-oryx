<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Query;
use Elastica\Query\BoolQuery;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class ErpOrderPageSearchExternalReferenceFilterQueryExpanderPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query\BoolQuery
     */
    protected $elasticaBoolQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected $pluginQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Query
     */
    protected $elasticaQueryMock;

    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension\ErpOrderPageSearchExternalReferenceFilterQueryExpanderPlugin
     */
    protected $erpOrderPageSearchExternalReferenceFilterQueryExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->pluginQueryMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->elasticaQueryMock = $this->getMockBuilder(Query::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->elasticaBoolQueryMock = $this->getMockBuilder(BoolQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchExternalReferenceFilterQueryExpanderPlugin =
            new ErpOrderPageSearchExternalReferenceFilterQueryExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpandQuery(): void
    {
        $requestParameters = [
            'filters' => [],
        ];

        $this->assertInstanceOf(
            QueryInterface::class,
            $this->erpOrderPageSearchExternalReferenceFilterQueryExpanderPlugin->expandQuery(
                $this->pluginQueryMock,
                $requestParameters
            )
        );
    }
}
