<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToCustomerClientBridge;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToErpInvoicePermissionClientInterface;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToSearchClientBridge;
use FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension\ErpInvoicePageSearchQueryPlugin;
use Spryker\Client\Kernel\Container;

class ErpInvoicePageSearchFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchFactory
     */
    protected $erpInvoicePageSearchFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension\ErpInvoicePageSearchQueryPlugin
     */
    protected $erpInvoicePageSearchQueryPluginMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToCustomerClientBridge
     */
    protected $erpInvoicePageSearchToCustomerClientMock;

    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToErpInvoicePermissionClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $erpInvoicePageSearchToErpInvoicePermissionClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToSearchClientBridge
     */
    protected $erpInvoicePageSearchToSearchClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchQueryPluginMock = $this->getMockBuilder(ErpInvoicePageSearchQueryPlugin::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchToCustomerClientMock = $this->getMockBuilder(ErpInvoicePageSearchToCustomerClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchToErpInvoicePermissionClientMock = $this->getMockBuilder(ErpInvoicePageSearchToErpInvoicePermissionClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchToSearchClientMock = $this->getMockBuilder(ErpInvoicePageSearchToSearchClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchFactory = new ErpInvoicePageSearchFactory();
        $this->erpInvoicePageSearchFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateSearchQuery(): void
    {
        $searchString = '';

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpInvoicePageSearchDependencyProvider::PLUGIN_SEARCH_QUERY)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpInvoicePageSearchDependencyProvider::PLUGIN_SEARCH_QUERY)
            ->willReturn($this->erpInvoicePageSearchQueryPluginMock);

        static::assertEquals(
            $this->erpInvoicePageSearchQueryPluginMock,
            $this->erpInvoicePageSearchFactory->createSearchQuery($searchString),
        );
    }

    /**
     * @return void
     */
    public function testGetCustomerClient(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpInvoicePageSearchDependencyProvider::CLIENT_CUSTOMER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpInvoicePageSearchDependencyProvider::CLIENT_CUSTOMER)
            ->willReturn($this->erpInvoicePageSearchToCustomerClientMock);

        static::assertEquals(
            $this->erpInvoicePageSearchToCustomerClientMock,
            $this->erpInvoicePageSearchFactory->getCustomerClient(),
        );
    }

    /**
     * @return void
     */
    public function testGetErpInvoicePermissionClient(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpInvoicePageSearchDependencyProvider::CLIENT_ERP_INVOICE_PERMISSION)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpInvoicePageSearchDependencyProvider::CLIENT_ERP_INVOICE_PERMISSION)
            ->willReturn($this->erpInvoicePageSearchToErpInvoicePermissionClientMock);

        static::assertEquals(
            $this->erpInvoicePageSearchToErpInvoicePermissionClientMock,
            $this->erpInvoicePageSearchFactory->getErpInvoicePermissionClient(),
        );
    }

    /**
     * @return void
     */
    public function testGetSearchClient(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpInvoicePageSearchDependencyProvider::CLIENT_SEARCH)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpInvoicePageSearchDependencyProvider::CLIENT_SEARCH)
            ->willReturn($this->erpInvoicePageSearchToSearchClientMock);

        $this->assertInstanceOf(
            ErpInvoicePageSearchToSearchClientBridge::class,
            $this->erpInvoicePageSearchFactory->getSearchClient(),
        );
    }

    /**
     * @return void
     */
    public function testGetSearchResultFormatterPlugins(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpInvoicePageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpInvoicePageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER)
            ->willReturn([]);

        $this->assertIsArray($this->erpInvoicePageSearchFactory->getSearchResultFormatterPlugins());
    }

    /**
     * @return void
     */
    public function testGetSearchQueryExpanderPlugins(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpInvoicePageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpInvoicePageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER)
            ->willReturn([]);

        $this->assertIsArray($this->erpInvoicePageSearchFactory->getSearchQueryExpanderPlugins());
    }
}
