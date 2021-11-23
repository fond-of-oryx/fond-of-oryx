<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Result;
use Elastica\ResultSet;
use Generated\Shared\Search\ErpInvoiceIndexMap;

class RawErpInvoicePageSearchResultFormatterPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Result
     */
    protected $elasticaResultMock;

    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension\RawErpInvoicePageSearchResultFormatterPlugin
     */
    protected $rawErpInvoicePageSearchResultFormatterPlugin;

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

        $this->rawErpInvoicePageSearchResultFormatterPlugin = new RawErpInvoicePageSearchResultFormatterPlugin();
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        $this->assertIsString($this->rawErpInvoicePageSearchResultFormatterPlugin->getName());
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
                [ErpInvoiceIndexMap::SEARCH_RESULT_DATA => []],
            );

        $rawErpInvoices = $this->rawErpInvoicePageSearchResultFormatterPlugin
            ->formatSearchResult($this->resultSetMock, []);

        $this->assertIsArray($rawErpInvoices);
        $this->assertNotEmpty($rawErpInvoices);
    }
}
