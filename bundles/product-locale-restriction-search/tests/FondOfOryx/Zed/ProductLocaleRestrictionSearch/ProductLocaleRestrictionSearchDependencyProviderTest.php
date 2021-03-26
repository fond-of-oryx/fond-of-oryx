<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionSearch;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductLocaleRestriction\Business\ProductLocaleRestrictionFacadeInterface;
use FondOfOryx\Zed\ProductLocaleRestrictionSearch\Dependency\Facade\ProductLocaleRestrictionSearchToProductLocaleRestrictionFacadeInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class ProductLocaleRestrictionSearchDependencyProviderTest extends Unit
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
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionSearch\ProductLocaleRestrictionSearchDependencyProvider
     */
    protected $productLocaleRestrictionSearchDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionFacadeMock = $this->getMockBuilder(ProductLocaleRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionSearchDependencyProvider = new ProductLocaleRestrictionSearchDependencyProvider();
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
            ->with('productLocaleRestriction')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturn($this->productLocaleRestrictionFacadeMock);

        $container = $this->productLocaleRestrictionSearchDependencyProvider->provideCommunicationLayerDependencies(
            $this->containerMock
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            ProductLocaleRestrictionSearchToProductLocaleRestrictionFacadeInterface::class,
            $container[ProductLocaleRestrictionSearchDependencyProvider::FACADE_PRODUCT_LOCALE_RESTRICTION]
        );
    }
}
