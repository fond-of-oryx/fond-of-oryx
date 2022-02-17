<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Query;
use Generated\Shared\Transfer\SearchContextTransfer;

class ErpDeliveryNotePageSearchQueryPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension\ErpDeliveryNotePageSearchQueryPlugin
     */
    protected $erpDeliveryNotePageSearchQueryPlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\SearchContextTransfer
     */
    protected $searchContextTransfer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->searchContextTransfer = $this->getMockBuilder(SearchContextTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchQueryPlugin = new ErpDeliveryNotePageSearchQueryPlugin();
    }

    /**
     * @return void
     */
    public function testGetSearchQuery(): void
    {
        $this->assertInstanceOf(
            Query::class,
            $this->erpDeliveryNotePageSearchQueryPlugin->getSearchQuery(),
        );
    }

    /**
     * @return void
     */
    public function testGetSearchContext(): void
    {
        $this->assertInstanceOf(
            SearchContextTransfer::class,
            $this->erpDeliveryNotePageSearchQueryPlugin->getSearchContext(),
        );
    }

    /**
     * @return void
     */
    public function testGetSearchString(): void
    {
        $this->assertIsString($this->erpDeliveryNotePageSearchQueryPlugin->getSearchString());
    }

    /**
     * @return void
     */
    public function testSetSearchContext(): void
    {
        $this->erpDeliveryNotePageSearchQueryPlugin->setSearchContext($this->searchContextTransfer);

        $this->assertEquals(
            $this->searchContextTransfer,
            $this->erpDeliveryNotePageSearchQueryPlugin->getSearchContext(),
        );
    }

    /**
     * @return void
     */
    public function testSetSearchString(): void
    {
        $searchString = 'searchString';
        $this->erpDeliveryNotePageSearchQueryPlugin->setSearchString(
            $searchString,
        );

        $this->assertEquals(
            $searchString,
            $this->erpDeliveryNotePageSearchQueryPlugin->getSearchString(),
        );
    }
}
