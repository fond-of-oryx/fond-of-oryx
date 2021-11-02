<?php

namespace FondOfOryx\Zed\SplittableQuoteShipmentConnector;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableQuoteShipmentConnector\Dependency\Facade\SplittableQuoteShipmentConnectorToShipmentFacadeBridge;
use Spryker\Shared\Kernel\BundleProxy;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Kernel\Locator;
use Spryker\Zed\Shipment\Business\ShipmentFacadeInterface;

class SplittableQuoteShipmentConnectorDependencyProviderTest extends Unit
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
     * @var \FondOfOryx\Zed\SplittableQuoteShipmentConnector\SplittableQuoteShipmentConnectorDependencyProvider
     */
    protected $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->setMethodsExcept(['factory', 'set', 'offsetSet', 'get', 'offsetGet', 'has', 'offsetExists'])
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

        $this->dependencyProvider = new SplittableQuoteShipmentConnectorDependencyProvider();
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
            ->with('shipment')
            ->willReturn($this->bundleProxyMock);

        $this->bundleProxyMock->expects(static::atLeastOnce())
            ->method('__call')
            ->with('facade')
            ->willReturn($this->shipmentFacadeMock);

        $container = $this->dependencyProvider->provideBusinessLayerDependencies(
            $this->containerMock,
        );

        static::assertEquals($this->containerMock, $container);
        static::assertInstanceOf(
            SplittableQuoteShipmentConnectorToShipmentFacadeBridge::class,
            $container[SplittableQuoteShipmentConnectorDependencyProvider::FACADE_SHIPMENT],
        );
    }
}
