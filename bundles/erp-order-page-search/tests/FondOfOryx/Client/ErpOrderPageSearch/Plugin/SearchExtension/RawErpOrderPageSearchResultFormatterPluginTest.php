<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Result;
use Elastica\ResultSet;
use Generated\Shared\Search\ErpOrderIndexMap;

class RawErpOrderPageSearchResultFormatterPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Result
     */
    protected $elasticaResultMock;

    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension\RawErpOrderPageSearchResultFormatterPlugin
     */
    protected $rawErpOrderPageSearchResultFormatterPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\ResultSet
     */
    protected $resultSetMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->resultSetMock = $this->getMockBuilder(ResultSet::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->elasticaResultMock = $this->getMockBuilder(Result::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->rawErpOrderPageSearchResultFormatterPlugin = new RawErpOrderPageSearchResultFormatterPlugin();
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        $this->assertIsString($this->rawErpOrderPageSearchResultFormatterPlugin->getName());
    }

    /**
     * @return void
     */
    public function testFormatSearchResult(): void
    {
        $results = [$this->elasticaResultMock];

        $this->resultSetMock->expects(static::atLeastOnce())
            ->method('getResults')
            ->willReturn($results);

        $this->elasticaResultMock->expects(static::atLeastOnce())
            ->method('getSource')
            ->willReturn(
                [ErpOrderIndexMap::SEARCH_RESULT_DATA => []]
            );

        $rawErpOrders = $this->rawErpOrderPageSearchResultFormatterPlugin
            ->formatSearchResult($this->resultSetMock, []);

        $this->assertIsArray($rawErpOrders);
        $this->assertNotEmpty($rawErpOrders);
    }
}
