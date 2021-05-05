<?php

namespace FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi\Dependency\Facade\SplittableCheckoutShipmentsRestApiToShipmentFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Shipment\Business\ShipmentFacadeInterface;

class SplittableCheckoutShipmentsRestApiDependencyProviderTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Shipment\Business\ShipmentFacadeInterface
     */
    protected $shipmentFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutShipmentsRestApi\SplittableCheckoutShipmentsRestApiDependencyProvider
     */
    protected $splittableCheckoutShipmentsRestApiDependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet'])
            ->getMock();

        $this->locatorMock = $this->getMockBuilder(Locator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bundleProxyMock = $this->getMockBuilder(BundleProxy::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentFacadeMock = $this->getMockBuilder(ShipmentFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutShipmentsRestApiDependencyProvider =
            new SplittableCheckoutShipmentsRestApiDependencyProvider();
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
            ->withConsecutive(['shipment'])
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->withConsecutive(['facade'])
            ->willReturnOnConsecutiveCalls(
                $this->shipmentFacadeMock
            );

        $container = $this->splittableCheckoutShipmentsRestApiDependencyProvider
            ->provideBusinessLayerDependencies($this->containerMock);

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            SplittableCheckoutShipmentsRestApiToShipmentFacadeBridge::class,
            $container[SplittableCheckoutShipmentsRestApiDependencyProvider::FACADE_SHIPMENT]
        );
    }
}
