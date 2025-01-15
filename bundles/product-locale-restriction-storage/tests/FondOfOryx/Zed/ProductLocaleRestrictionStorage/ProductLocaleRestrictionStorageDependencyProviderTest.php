<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacadeInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class ProductLocaleRestrictionStorageDependencyProviderTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacadeInterface
     */
    protected $productLocaleRestrictionFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected $eventBehaviorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageDependencyProvider
     */
    protected $productLocaleRestrictionStorageDependencyProvider;

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

        $this->productLocaleRestrictionFacadeMock = $this->getMockBuilder(ProductLocaleRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventBehaviorFacadeMock = $this->getMockBuilder(EventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionStorageDependencyProvider = new ProductLocaleRestrictionStorageDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideCommunicationLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('eventBehavior')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturn($this->eventBehaviorFacadeMock);

        $container = $this->productLocaleRestrictionStorageDependencyProvider->provideCommunicationLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            ProductLocaleRestrictionStorageToEventBehaviorFacadeInterface::class,
            $container[ProductLocaleRestrictionStorageDependencyProvider::FACADE_EVENT_BEHAVIOR],
        );
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('getLocator')
            ->willReturn($this->locatorMock);

        $this->locatorMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('productLocaleRestriction')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturn($this->productLocaleRestrictionFacadeMock);

        $container = $this->productLocaleRestrictionStorageDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            ProductLocaleRestrictionStorageToProductLocaleRestrictionFacadeInterface::class,
            $container[ProductLocaleRestrictionStorageDependencyProvider::FACADE_PRODUCT_LOCALE_RESTRICTION],
        );
    }
}
