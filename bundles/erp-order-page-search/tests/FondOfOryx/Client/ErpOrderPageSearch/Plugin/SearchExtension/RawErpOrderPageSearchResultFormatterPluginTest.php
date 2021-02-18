<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\ResultSet;

class RawErpOrderPageSearchResultFormatterPluginTest extends Unit
{
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
        $this->resultSetMock->expects(static::atLeastOnce())
            ->method('getResults')
            ->willReturn([]);

        $this->assertIsArray(
            $this->rawErpOrderPageSearchResultFormatterPlugin
                ->formatSearchResult($this->resultSetMock, [])
        );
    }

}
