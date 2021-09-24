<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\Dependency\Facade\JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeBridge;
use FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionFacadeInterface;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class JellyfishSalesOrderGiftCardConnectorDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ProductCartCodeTypeRestriction\Business\ProductCartCodeTypeRestrictionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $productCartCodeTypeRestrictionFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardConnector\JellyfishSalesOrderGiftCardConnectorDependencyProvider
     */
    protected $jellyfishSalesOrderGiftCardConnectorDependencyProvider;

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

        $this->productCartCodeTypeRestrictionFacadeMock = $this->getMockBuilder(ProductCartCodeTypeRestrictionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishSalesOrderGiftCardConnectorDependencyProvider = new JellyfishSalesOrderGiftCardConnectorDependencyProvider();
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
            ->withConsecutive(['productCartCodeTypeRestriction'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'])
            ->willReturnOnConsecutiveCalls($this->productCartCodeTypeRestrictionFacadeMock);

        $container = $this->jellyfishSalesOrderGiftCardConnectorDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            JellyfishSalesOrderGiftCardConnectorToProductCardCodeTypeRestrictionFacadeBridge::class,
            $container[JellyfishSalesOrderGiftCardConnectorDependencyProvider::FACADE_PRODUCT_CART_CODE_TYPE_RESTRICTION]
        );
    }
}
