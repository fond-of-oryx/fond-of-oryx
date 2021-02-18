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
     * @return void
     */
    protected function _before(): void
    {
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
}
