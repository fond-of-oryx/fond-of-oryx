<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Result;
use Elastica\ResultSet;
use Generated\Shared\Search\ErpDeliveryNoteIndexMap;

class RawErpDeliveryNotePageSearchResultFormatterPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Elastica\Result
     */
    protected $elasticaResultMock;

    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension\RawErpDeliveryNotePageSearchResultFormatterPlugin
     */
    protected $rawErpDeliveryNotePageSearchResultFormatterPlugin;

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

        $this->rawErpDeliveryNotePageSearchResultFormatterPlugin = new RawErpDeliveryNotePageSearchResultFormatterPlugin();
    }

    /**
     * @return void
     */
    public function testGetName(): void
    {
        $this->assertIsString($this->rawErpDeliveryNotePageSearchResultFormatterPlugin->getName());
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
                [ErpDeliveryNoteIndexMap::SEARCH_RESULT_DATA => []],
            );

        $rawErpDeliveryNotes = $this->rawErpDeliveryNotePageSearchResultFormatterPlugin
            ->formatSearchResult($this->resultSetMock, []);

        $this->assertIsArray($rawErpDeliveryNotes);
        $this->assertNotEmpty($rawErpDeliveryNotes);
    }
}
