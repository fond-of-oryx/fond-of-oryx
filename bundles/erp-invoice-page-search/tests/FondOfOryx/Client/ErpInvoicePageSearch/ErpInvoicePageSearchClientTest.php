<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToSearchClientInterface;
use Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface;

class ErpInvoicePageSearchClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchClientInterface
     */
    protected $erpInvoicePageSearchClient;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchFactory
     */
    protected $erpInvoicePageSearchFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToSearchClientInterface
     */
    protected $erpInvoicePageSearchToSearchClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\SearchExtension\Dependency\Plugin\QueryInterface
     */
    protected $pluginQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpInvoicePageSearchFactoryMock = $this->getMockBuilder(ErpInvoicePageSearchFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginQueryMock = $this->getMockBuilder(QueryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchToSearchClientMock = $this->getMockBuilder(ErpInvoicePageSearchToSearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchClient = new class () extends ErpInvoicePageSearchClient {
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

        $this->erpInvoicePageSearchClient->setFactory($this->erpInvoicePageSearchFactoryMock);
    }

    /**
     * @return void
     */
    public function testSearch(): void
    {
        $searchString = 'search-string';
        $this->erpInvoicePageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('createSearchQuery')
            ->with($searchString)
            ->willReturn($this->pluginQueryMock);

        $this->erpInvoicePageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getSearchClient')
            ->willReturn($this->erpInvoicePageSearchToSearchClientMock);

        $this->erpInvoicePageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getSearchQueryExpanderPlugins')
            ->willReturn([]);

        $this->erpInvoicePageSearchFactoryMock->expects(static::atLeastOnce())
            ->method('getSearchResultFormatterPlugins')
            ->willReturn([]);

        $this->erpInvoicePageSearchToSearchClientMock->expects(static::atLeastOnce())
            ->method('expandQuery')
            ->with($this->pluginQueryMock, [], [])
            ->willReturn($this->pluginQueryMock);

        $this->erpInvoicePageSearchToSearchClientMock->expects(static::atLeastOnce())
            ->method('search')
            ->willReturn([]);

        $this->assertIsArray($this->erpInvoicePageSearchClient->search($searchString));
    }
}
