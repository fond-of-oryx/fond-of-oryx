<?php

namespace FondOfOryx\Zed\ProductDefaultCategoryAssigner;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ProductDefaultCategoryAssigner\Dependency\Facade\ProductDefaultCategoryAssignerToProductCategoryFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\ProductCategory\Business\ProductCategoryFacadeInterface;

class ProductDefaultCategoryAssignerDependencyProviderTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\ProductCategory\Business\ProductCategoryFacadeInterface
     */
    protected $productCategoryFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ProductDefaultCategoryAssigner\ProductDefaultCategoryAssignerDependencyProvider
     */
    protected $productDefaultCategoryAssignerDependencyProvider;

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

        $this->productCategoryFacadeMock = $this->getMockBuilder(ProductCategoryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productDefaultCategoryAssignerDependencyProvider = new ProductDefaultCategoryAssignerDependencyProvider();
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
            ->with('productCategory')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturn($this->productCategoryFacadeMock);

        $container = $this->productDefaultCategoryAssignerDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            ProductDefaultCategoryAssignerToProductCategoryFacadeBridge::class,
            $container[ProductDefaultCategoryAssignerDependencyProvider::FACADE_PRODUCT_CATEGORY],
        );
    }
}
