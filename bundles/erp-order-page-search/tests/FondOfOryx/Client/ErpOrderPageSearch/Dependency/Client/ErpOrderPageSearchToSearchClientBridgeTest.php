<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class ErpOrderPageSearchToSearchClientBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToSearchClientInterface
     */
    protected $erpOrderPageSearchToSearchClientBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected $pluginQueryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\SearchClientInterface
     */
    protected $searchClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->pluginQueryMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchClientMock = $this->getMockBuilder(SearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToSearchClientBridge = new ErpOrderPageSearchToSearchClientBridge(
            $this->searchClientMock
        );
    }

    /**
     * @return void
     */
    public function testSearch(): void
    {
        $this->searchClientMock->expects(static::atLeastOnce())
            ->method('search')
            ->with($this->pluginQueryMock, [], [])
            ->willReturn([]);

        $this->assertIsArray(
            $this->erpOrderPageSearchToSearchClientBridge->search($this->pluginQueryMock, [], [])
        );
    }

    /**
     * @return void
     */
    public function testExpandQuery(): void
    {
        $this->searchClientMock->expects(static::atLeastOnce())
            ->method('expandQuery')
            ->with($this->pluginQueryMock, [], [])
            ->willReturn($this->pluginQueryMock);

        static::assertEquals(
            $this->pluginQueryMock,
            $this->erpOrderPageSearchToSearchClientBridge->expandQuery($this->pluginQueryMock, [], [])
        );
    }
}
