<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Query;
use Generated\Shared\Transfer\SearchContextTransfer;

class ErpOrderPageSearchQueryPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension\ErpOrderPageSearchQueryPlugin
     */
    protected $erpOrderPageSearchQueryPlugin;

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

        $this->erpOrderPageSearchQueryPlugin = new ErpOrderPageSearchQueryPlugin();
    }

    /**
     * @return void
     */
    public function testGetSearchQuery(): void
    {
        $this->assertInstanceOf(
            Query::class,
            $this->erpOrderPageSearchQueryPlugin->getSearchQuery()
        );
    }

    /**
     * @return void
     */
    public function testGetSearchContext(): void
    {
        $this->assertInstanceOf(
            SearchContextTransfer::class,
            $this->erpOrderPageSearchQueryPlugin->getSearchContext()
        );
    }

    /**
     * @return void
     */
    public function testGetSearchString(): void
    {
        $this->assertIsString($this->erpOrderPageSearchQueryPlugin->getSearchString());
    }

    /**
     * @return void
     */
    public function testSetSearchContext(): void
    {
        $this->erpOrderPageSearchQueryPlugin->setSearchContext($this->searchContextTransfer);

        $this->assertEquals(
            $this->searchContextTransfer,
            $this->erpOrderPageSearchQueryPlugin->getSearchContext()
        );
    }

    /**
     * @return void
     */
    public function testSetSearchString(): void
    {
        $searchString = 'searchString';
        $this->erpOrderPageSearchQueryPlugin->setSearchString(
            $searchString
        );

        $this->assertEquals(
            $searchString,
            $this->erpOrderPageSearchQueryPlugin->getSearchString()
        );
    }
}
