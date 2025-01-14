<?php

namespace FondOfOryx\Client\ErpOrderPageSearch;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToCustomerClientBridge;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToErpOrderPermissionClientBridge;
use FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client\ErpOrderPageSearchToSearchClientBridge;
use FondOfOryx\Client\ErpOrderPageSearch\Plugin\SearchExtension\ErpOrderPageSearchQueryPlugin;
use FondOfOryx\Client\ErpOrderPermission\ErpOrderPermissionClientInterface;
use Spryker\Client\Customer\CustomerClientInterface;
use Spryker\Client\Kernel\Container;
use Spryker\Client\Kernel\Locator;
use Spryker\Client\Search\SearchClientInterface;
use Spryker\Shared\Kernel\BundleProxy;

class ErpOrderPageSearchDependencyProviderTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Client\ErpOrderPermission\ErpOrderPermissionClientInterface
     */
    protected $erpOrderPermissionClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Search\SearchClientInterface
     */
    protected $searchClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Session\SessionClientInterface
     */
    protected $sessionClientMock;

    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchDependencyProvider
     */
    protected $erpOrderPageSearchDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $containerMock = $this->getMockBuilder(Container::class);

        /** @phpstan-ignore-next-line */
        if (method_exists($containerMock, 'setMethodsExcept')) {
            /** @phpstan-ignore-next-line */
            $containerMock->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet']);
        } else {
            /** @phpstan-ignore-next-line */
            $containerMock->onlyMethods(['getLocator'])->enableOriginalClone();
        }

        $this->containerMock = $containerMock->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->searchClientMock = $this->getMockBuilder(SearchClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerClientMock = $this->getMockBuilder(CustomerClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPermissionClientMock = $this->getMockBuilder(ErpOrderPermissionClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchDependencyProvider = new ErpOrderPageSearchDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceLayerDependencies(): void
    {
        $self = $this;
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case 'search':
                        return $self->bundleProxyMock;
                    case 'customer':
                        return $self->bundleProxyMock;
                    case 'erpOrderPermission':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('client')
            ->willReturnOnConsecutiveCalls(
                $this->searchClientMock,
                $this->customerClientMock,
                $this->erpOrderPermissionClientMock,
            );

        $container = $this->erpOrderPageSearchDependencyProvider->provideServiceLayerDependencies($this->containerMock);

        $this->assertEquals($this->containerMock, $container);

        $this->assertInstanceOf(
            ErpOrderPageSearchToSearchClientBridge::class,
            $container[ErpOrderPageSearchDependencyProvider::CLIENT_SEARCH],
        );

        $this->assertInstanceOf(
            ErpOrderPageSearchToCustomerClientBridge::class,
            $container[ErpOrderPageSearchDependencyProvider::CLIENT_CUSTOMER],
        );

        $this->assertInstanceOf(
            ErpOrderPageSearchToErpOrderPermissionClientBridge::class,
            $container[ErpOrderPageSearchDependencyProvider::CLIENT_ERP_ORDER_PERMISSION],
        );

        $this->assertInstanceOf(
            ErpOrderPageSearchQueryPlugin::class,
            $container[ErpOrderPageSearchDependencyProvider::PLUGIN_SEARCH_QUERY],
        );

        $this->assertIsArray(
            $container[ErpOrderPageSearchDependencyProvider::PLUGINS_SEARCH_QUERY_EXPANDER],
        );

        $this->assertIsArray(
            $container[ErpOrderPageSearchDependencyProvider::PLUGINS_SEARCH_RESULT_FORMATTER],
        );
    }
}
