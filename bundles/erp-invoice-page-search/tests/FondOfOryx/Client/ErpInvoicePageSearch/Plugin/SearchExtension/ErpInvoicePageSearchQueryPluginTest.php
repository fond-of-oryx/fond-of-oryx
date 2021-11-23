<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension;

use Codeception\Test\Unit;
use Elastica\Query;
use Generated\Shared\Transfer\SearchContextTransfer;

class ErpInvoicePageSearchQueryPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension\ErpInvoicePageSearchQueryPlugin
     */
    protected $erpInvoicePageSearchQueryPlugin;

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

        $this->erpInvoicePageSearchQueryPlugin = new ErpInvoicePageSearchQueryPlugin();
    }

    /**
     * @return void
     */
    public function testGetSearchQuery(): void
    {
        $this->assertInstanceOf(
            Query::class,
            $this->erpInvoicePageSearchQueryPlugin->getSearchQuery(),
        );
    }

    /**
     * @return void
     */
    public function testGetSearchContext(): void
    {
        $this->assertInstanceOf(
            SearchContextTransfer::class,
            $this->erpInvoicePageSearchQueryPlugin->getSearchContext(),
        );
    }

    /**
     * @return void
     */
    public function testGetSearchString(): void
    {
        $this->assertIsString($this->erpInvoicePageSearchQueryPlugin->getSearchString());
    }

    /**
     * @return void
     */
    public function testSetSearchContext(): void
    {
        $this->erpInvoicePageSearchQueryPlugin->setSearchContext($this->searchContextTransfer);

        $this->assertEquals(
            $this->searchContextTransfer,
            $this->erpInvoicePageSearchQueryPlugin->getSearchContext(),
        );
    }

    /**
     * @return void
     */
    public function testSetSearchString(): void
    {
        $searchString = 'searchString';
        $this->erpInvoicePageSearchQueryPlugin->setSearchString(
            $searchString,
        );

        $this->assertEquals(
            $searchString,
            $this->erpInvoicePageSearchQueryPlugin->getSearchString(),
        );
    }
}
