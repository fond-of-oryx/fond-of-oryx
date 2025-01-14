<?php

namespace FondOfOryx\Zed\JellyfishSalesOrder;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToOmsFacadeBridge;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Facade\JellyfishSalesOrderToStoreFacadeBridge;
use FondOfOryx\Zed\JellyfishSalesOrder\Dependency\Service\JellyfishSalesOrderToUtilEncodingServiceBridge;
use Spryker\Service\UtilEncoding\UtilEncodingServiceInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Oms\Business\OmsFacadeInterface;
use Spryker\Zed\Store\Business\StoreFacadeInterface;

class JellyfishSalesOrderDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Oms\Business\OmsFacadeInterface|mixed
     */
    protected $omsFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Store\Business\StoreFacadeInterface|mixed
     */
    protected $storeFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\UtilEncoding\UtilEncodingServiceInterface
     */
    protected $utilEncodingServiceMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrder\JellyfishSalesOrderDependencyProvider
     */
    protected $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

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

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->omsFacadeMock = $this->getMockBuilder(OmsFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->storeFacadeMock = $this->getMockBuilder(StoreFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->utilEncodingServiceMock = $this->getMockBuilder(UtilEncodingServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new JellyfishSalesOrderDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $self = $this;
        $this->containerMock->expects($this->atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects($this->atLeastOnce())
            ->method('__call')
            ->willReturnCallback(static function (string $key) use ($self) {
                switch ($key) {
                    case 'oms':
                        return $self->bundleProxyMock;
                    case 'store':
                        return $self->bundleProxyMock;
                    case 'utilEncoding':
                        return $self->bundleProxyMock;
                }

                throw new Exception('Invalid key');
            });

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->willReturnOnConsecutiveCalls(
                $this->omsFacadeMock,
                $this->storeFacadeMock,
                $this->utilEncodingServiceMock,
            );

        static::assertEquals(
            $this->containerMock,
            $this->dependencyProvider->provideBusinessLayerDependencies($this->containerMock),
        );

        static::assertInstanceOf(
            JellyfishSalesOrderToOmsFacadeBridge::class,
            $this->containerMock[JellyfishSalesOrderDependencyProvider::FACADE_OMS],
        );

        static::assertInstanceOf(
            JellyfishSalesOrderToStoreFacadeBridge::class,
            $this->containerMock[JellyfishSalesOrderDependencyProvider::FACADE_STORE],
        );

        static::assertInstanceOf(
            JellyfishSalesOrderToUtilEncodingServiceBridge::class,
            $this->containerMock[JellyfishSalesOrderDependencyProvider::SERVICE_UTIL_ENCODING],
        );

        static::assertIsArray(
            $this->containerMock[JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_ADDRESS_EXPANDER_POST_MAP],
        );

        static::assertIsArray(
            $this->containerMock[JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_EXPANDER_POST_MAP],
        );

        static::assertIsArray(
            $this->containerMock[JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_ITEM_EXPANDER_POST_MAP],
        );

        static::assertIsArray(
            $this->containerMock[JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_POST_MAP],
        );

        static::assertIsArray(
            $this->containerMock[JellyfishSalesOrderDependencyProvider::PLUGINS_JELLYFISH_ORDER_BEFORE_EXPORT],
        );
    }
}
