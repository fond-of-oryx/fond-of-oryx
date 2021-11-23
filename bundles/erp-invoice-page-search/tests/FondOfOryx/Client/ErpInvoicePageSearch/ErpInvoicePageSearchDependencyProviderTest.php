<?php

namespace FondOfOryx\Client\ErpInvoicePageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToCustomerClientBridge;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToErpInvoicePermissionClientBridge;
use FondOfOryx\Client\ErpInvoicePageSearch\Dependency\Client\ErpInvoicePageSearchToSearchClientBridge;
use FondOfOryx\Client\ErpInvoicePageSearch\Plugin\SearchExtension\ErpInvoicePageSearchQueryPlugin;
use FondOfOryx\Client\ErpInvoicePermission\ErpInvoicePermissionClientInterface;
use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Kernel\Locator;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Shared\Kernel\BundleProxy;

class ErpInvoicePageSearchDependencyProviderTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpInvoicePermission\ErpInvoicePermissionClientInterface
     */
    protected $erpInvoicePermissionClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\SearchClientInterface
     */
    protected $searchClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Session\SessionClientInterface
     */
    protected $sessionClientMock;

    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchDependencyProvider
     */
    protected $erpInvoicePageSearchDependencyProvider;

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

        $this->erpInvoicePermissionClientMock = $this->getMockBuilder(ErpInvoicePermissionClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoicePageSearchDependencyProvider = new ErpInvoicePageSearchDependencyProvider();
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
            ->withConsecutive(['search'], ['customer'], ['erpInvoicePermission'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('client')
            ->willReturnOnConsecutiveCalls(
                $this->searchClientMock,
                $this->customerClientMock,
                $this->erpInvoicePermissionClientMock,
            );

        $container = $this->erpInvoicePageSearchDependencyProvider->provideServiceLayerDependencies($this->containerMock);

        $this->assertEquals($this->containerMock, $container);

        $this->assertInstanceOf(
            ErpInvoicePageSearchToSearchClientBridge::class,
            $container[ErpInvoicePageSearchDependencyProvider::CLIENT_SEARCH],
        );

        $this->assertInstanceOf(
            ErpInvoicePageSearchToCustomerClientBridge::class,
            $container[ErpInvoicePageSearchDependencyProvider::CLIENT_CUSTOMER],
        );

        $this->assertInstanceOf(
            ErpInvoicePageSearchToErpInvoicePermissionClientBridge::class,
            $container[ErpInvoicePageSearchDependencyProvider::CLIENT_ERP_INVOICE_PERMISSION],
        );

        $this->assertInstanceOf(
            ErpInvoicePageSearchQueryPlugin::class,
            $container[ErpInvoicePageSearchDependencyProvider::PLUGIN_SEARCH_QUERY],
        );

        $this->assertIsArray(
            $container[ErpInvoicePageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER],
        );

        $this->assertIsArray(
            $container[ErpInvoicePageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER],
        );
    }
}
