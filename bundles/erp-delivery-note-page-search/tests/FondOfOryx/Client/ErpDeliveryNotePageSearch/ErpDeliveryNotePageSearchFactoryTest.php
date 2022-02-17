<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToCustomerClientBridge;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientInterface;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToSearchClientBridge;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension\ErpDeliveryNotePageSearchQueryPlugin;
use Spryker\Client\Kernel\Container;

class ErpDeliveryNotePageSearchFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchFactory
     */
    protected $erpDeliveryNotePageSearchFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension\ErpDeliveryNotePageSearchQueryPlugin
     */
    protected $erpDeliveryNotePageSearchQueryPluginMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToCustomerClientBridge
     */
    protected $erpDeliveryNotePageSearchToCustomerClientMock;

    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $erpDeliveryNotePageSearchToErpDeliveryNotePermissionClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToSearchClientBridge
     */
    protected $erpDeliveryNotePageSearchToSearchClientMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchQueryPluginMock = $this->getMockBuilder(ErpDeliveryNotePageSearchQueryPlugin::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchToCustomerClientMock = $this->getMockBuilder(ErpDeliveryNotePageSearchToCustomerClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchToErpDeliveryNotePermissionClientMock = $this->getMockBuilder(ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchToSearchClientMock = $this->getMockBuilder(ErpDeliveryNotePageSearchToSearchClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchFactory = new ErpDeliveryNotePageSearchFactory();
        $this->erpDeliveryNotePageSearchFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateSearchQuery(): void
    {
        $searchString = '';

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::PLUGIN_SEARCH_QUERY)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::PLUGIN_SEARCH_QUERY)
            ->willReturn($this->erpDeliveryNotePageSearchQueryPluginMock);

        static::assertEquals(
            $this->erpDeliveryNotePageSearchQueryPluginMock,
            $this->erpDeliveryNotePageSearchFactory->createSearchQuery($searchString),
        );
    }

    /**
     * @return void
     */
    public function testGetCustomerClient(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::CLIENT_CUSTOMER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::CLIENT_CUSTOMER)
            ->willReturn($this->erpDeliveryNotePageSearchToCustomerClientMock);

        static::assertEquals(
            $this->erpDeliveryNotePageSearchToCustomerClientMock,
            $this->erpDeliveryNotePageSearchFactory->getCustomerClient(),
        );
    }

    /**
     * @return void
     */
    public function testGetErpDeliveryNotePermissionClient(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::CLIENT_ERP_DELIVERY_NOTE_PERMISSION)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::CLIENT_ERP_DELIVERY_NOTE_PERMISSION)
            ->willReturn($this->erpDeliveryNotePageSearchToErpDeliveryNotePermissionClientMock);

        static::assertEquals(
            $this->erpDeliveryNotePageSearchToErpDeliveryNotePermissionClientMock,
            $this->erpDeliveryNotePageSearchFactory->getErpDeliveryNotePermissionClient(),
        );
    }

    /**
     * @return void
     */
    public function testGetSearchClient(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::CLIENT_SEARCH)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::CLIENT_SEARCH)
            ->willReturn($this->erpDeliveryNotePageSearchToSearchClientMock);

        $this->assertInstanceOf(
            ErpDeliveryNotePageSearchToSearchClientBridge::class,
            $this->erpDeliveryNotePageSearchFactory->getSearchClient(),
        );
    }

    /**
     * @return void
     */
    public function testGetSearchResultFormatterPlugins(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER)
            ->willReturn([]);

        $this->assertIsArray($this->erpDeliveryNotePageSearchFactory->getSearchResultFormatterPlugins());
    }

    /**
     * @return void
     */
    public function testGetSearchQueryExpanderPlugins(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpDeliveryNotePageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER)
            ->willReturn([]);

        $this->assertIsArray($this->erpDeliveryNotePageSearchFactory->getSearchQueryExpanderPlugins());
    }
}
