<?php

namespace FondOfOryx\Client\ErpOrderPageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToSearchClientInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class ErpOrderPageSearchClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchClientInterface
     */
    protected $erpOrderPageSearchClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory
     */
    protected $erpOrderPageSearchFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToSearchClientInterface
     */
    protected $erpOrderPageSearchToSearchClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected $pluginQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpOrderPageSearchFactoryMock = $this->getMockBuilder(ErpOrderPageSearchFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginQueryMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToSearchClientMock = $this->getMockBuilder(ErpOrderPageSearchToSearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchClient = new class () extends ErpOrderPageSearchClient {
            /**
             * @uses \Spryker\Client\Permission\PermissionClientInterface
             *
             * @param string $permissionKey
             * @param array|string|int|null $context
             *
             * @return bool
             */
            protected function can($permissionKey, $context = null): bool
            {
                return true;
            }
        };

        $this->erpOrderPageSearchClient->setFactory($this->erpOrderPageSearchFactoryMock);
    }

    /**
     * @return void
     */
    public function testSearch(): void
    {
        $searchString = 'search-string';
        $this->erpOrderPageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('createSearchQuery')
            ->with($searchString)
            ->willReturn($this->pluginQueryMock);

        $this->erpOrderPageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getSearchClient')
            ->willReturn($this->erpOrderPageSearchToSearchClientMock);

        $this->erpOrderPageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getSearchQueryExpanderPlugins')
            ->willReturn([]);

        $this->erpOrderPageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getSearchResultFormatterPlugins')
            ->willReturn([]);

        $this->erpOrderPageSearchToSearchClientMock->expects(static::atLeastOnce())
            ->method('expandQuery')
            ->with($this->pluginQueryMock, [], [])
            ->willReturn($this->pluginQueryMock);

        $this->erpOrderPageSearchToSearchClientMock->expects(static::atLeastOnce())
            ->method('search')
            ->willReturn([]);

        $this->assertIsArray($this->erpOrderPageSearchClient->search($searchString));
    }
}
