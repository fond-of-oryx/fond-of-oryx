<?php

namespace FondOfOryx\Client\ErpOrderPageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCustomerClientBridge;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToErpOrderPermissionClientInterface;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToSearchClientBridge;
use FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension\ErpOrderPageSearchQueryPlugin;
use Spryker\Client\Kernel\Container;

class ErpOrderPageSearchFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchFactory
     */
    protected $erpOrderPageSearchFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension\ErpOrderPageSearchQueryPlugin
     */
    protected $erpOrderPageSearchQueryPluginMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCustomerClientBridge
     */
    protected $erpOrderPageSearchToCustomerClientMock;

    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToErpOrderPermissionClientInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderPageSearchToErpOrderPermissionClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToSearchClientBridge
     */
    protected $erpOrderPageSearchToSearchClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchQueryPluginMock = $this->getMockBuilder(ErpOrderPageSearchQueryPlugin::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToCustomerClientMock = $this->getMockBuilder(ErpOrderPageSearchToCustomerClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToErpOrderPermissionClientMock = $this->getMockBuilder(ErpOrderPageSearchToErpOrderPermissionClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToSearchClientMock = $this->getMockBuilder(ErpOrderPageSearchToSearchClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchFactory = new ErpOrderPageSearchFactory();
        $this->erpOrderPageSearchFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateSearchQuery(): void
    {
        $searchString = '';

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpOrderPageSearchDependencyProvider::PLUGIN_SEARCH_QUERY)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpOrderPageSearchDependencyProvider::PLUGIN_SEARCH_QUERY)
            ->willReturn($this->erpOrderPageSearchQueryPluginMock);

        static::assertEquals(
            $this->erpOrderPageSearchQueryPluginMock,
            $this->erpOrderPageSearchFactory->createSearchQuery($searchString)
        );
    }

    /**
     * @return void
     */
    public function testGetCustomerClient(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpOrderPageSearchDependencyProvider::CLIENT_CUSTOMER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpOrderPageSearchDependencyProvider::CLIENT_CUSTOMER)
            ->willReturn($this->erpOrderPageSearchToCustomerClientMock);

        static::assertEquals(
            $this->erpOrderPageSearchToCustomerClientMock,
            $this->erpOrderPageSearchFactory->getCustomerClient()
        );
    }

    /**
     * @return void
     */
    public function testGetErpOrderPermissionClient(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpOrderPageSearchDependencyProvider::CLIENT_ERP_ORDER_PERMISSION)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpOrderPageSearchDependencyProvider::CLIENT_ERP_ORDER_PERMISSION)
            ->willReturn($this->erpOrderPageSearchToErpOrderPermissionClientMock);

        static::assertEquals(
            $this->erpOrderPageSearchToErpOrderPermissionClientMock,
            $this->erpOrderPageSearchFactory->getErpOrderPermissionClient()
        );
    }

    /**
     * @return void
     */
    public function testGetSearchClient(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpOrderPageSearchDependencyProvider::CLIENT_SEARCH)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpOrderPageSearchDependencyProvider::CLIENT_SEARCH)
            ->willReturn($this->erpOrderPageSearchToSearchClientMock);

        $this->assertInstanceOf(
            ErpOrderPageSearchToSearchClientBridge::class,
            $this->erpOrderPageSearchFactory->getSearchClient()
        );
    }

    /**
     * @return void
     */
    public function testGetSearchResultFormatterPlugins(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpOrderPageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpOrderPageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER)
            ->willReturn([]);

        $this->assertIsArray($this->erpOrderPageSearchFactory->getSearchResultFormatterPlugins());
    }

    /**
     * @return void
     */
    public function testGetSearchQueryExpanderPlugins(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpOrderPageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpOrderPageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER)
            ->willReturn([]);

        $this->assertIsArray($this->erpOrderPageSearchFactory->getSearchQueryExpanderPlugins());
    }
}
