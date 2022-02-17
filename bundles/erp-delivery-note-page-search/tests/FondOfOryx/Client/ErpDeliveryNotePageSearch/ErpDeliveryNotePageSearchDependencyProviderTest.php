<?php

namespace FondOfOryx\Client\ErpDeliveryNotePageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToCustomerClientBridge;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientBridge;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Dependency\Client\ErpDeliveryNotePageSearchToSearchClientBridge;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\Plugin\SearchExtension\ErpDeliveryNotePageSearchQueryPlugin;
use FondOfOryx\Client\ErpDeliveryNotePermission\ErpDeliveryNotePermissionClientInterface;
use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Kernel\Locator;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Shared\Kernel\BundleProxy;

class ErpDeliveryNotePageSearchDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Shared\Kernel\BundleProxy|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Customer\CustomerClientInterface
     */
    protected $customerClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpDeliveryNotePermission\ErpDeliveryNotePermissionClientInterface
     */
    protected $erpDeliveryNotePermissionClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\SearchClientInterface
     */
    protected $searchClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Session\SessionClientInterface
     */
    protected $sessionClientMock;

    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchDependencyProvider
     */
    protected $erpDeliveryNotePageSearchDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchClientMock = $this->getMockBuilder(SearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerClientMock = $this->getMockBuilder(CustomerClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePermissionClientMock = $this->getMockBuilder(ErpDeliveryNotePermissionClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNotePageSearchDependencyProvider = new ErpDeliveryNotePageSearchDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['search'], ['customer'], ['erpDeliveryNotePermission'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('client')
            ->willReturnOnConsecutiveCalls(
                $this->searchClientMock,
                $this->customerClientMock,
                $this->erpDeliveryNotePermissionClientMock,
            );

        $container = $this->erpDeliveryNotePageSearchDependencyProvider->provideServiceLayerDependencies($this->containerMock);

        $this->assertEquals($this->containerMock, $container);

        $this->assertInstanceOf(
            ErpDeliveryNotePageSearchToSearchClientBridge::class,
            $container[ErpDeliveryNotePageSearchDependencyProvider::CLIENT_SEARCH],
        );

        $this->assertInstanceOf(
            ErpDeliveryNotePageSearchToCustomerClientBridge::class,
            $container[ErpDeliveryNotePageSearchDependencyProvider::CLIENT_CUSTOMER],
        );

        $this->assertInstanceOf(
            ErpDeliveryNotePageSearchToErpDeliveryNotePermissionClientBridge::class,
            $container[ErpDeliveryNotePageSearchDependencyProvider::CLIENT_ERP_DELIVERY_NOTE_PERMISSION],
        );

        $this->assertInstanceOf(
            ErpDeliveryNotePageSearchQueryPlugin::class,
            $container[ErpDeliveryNotePageSearchDependencyProvider::PLUGIN_SEARCH_QUERY],
        );

        $this->assertIsArray(
            $container[ErpDeliveryNotePageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER],
        );

        $this->assertIsArray(
            $container[ErpDeliveryNotePageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER],
        );
    }
}
