<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderProductType;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderProductType\Dependency\Facade\JellyfishSalesOrderProductTypeToGiftCardFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\GiftCard\Business\GiftCardFacadeInterface;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;

class JellyfishSalesOrderProductTypeDependencyProviderTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $containerMock;

    /**
     * @var \Spryker\Zed\GiftCard\Business\GiftCardFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $giftCardFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Locator
     */
    protected $locatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\BundleProxy
     */
    protected $bundleProxyMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderProductType\JellyfishSalesOrderProductTypeDependencyProvider
     */
    protected $jellyfishSalesOrderProductTypeDependencyProvider;

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

        $this->giftCardFacadeMock = $this->getMockBuilder(GiftCardFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishSalesOrderProductTypeDependencyProvider = new JellyfishSalesOrderProductTypeDependencyProvider();
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
            ->withConsecutive(['giftCard'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'])
            ->willReturnOnConsecutiveCalls($this->giftCardFacadeMock);

        $container = $this->jellyfishSalesOrderProductTypeDependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            JellyfishSalesOrderProductTypeToGiftCardFacadeBridge::class,
            $container[JellyfishSalesOrderProductTypeDependencyProvider::FACADE_GIFT_CARD],
        );
    }
}
