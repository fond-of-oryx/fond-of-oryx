<?php

namespace FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business\Expander\SplittedQuoteExpander;
use FondOfOryx\Zed\SplittableTotalsShipmentConnector\Dependency\Facade\SplittableTotalsShipmentConnectorToShipmentFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsShipmentConnector\SplittableTotalsShipmentConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableTotalsShipmentConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsShipmentConnector\Dependency\Facade\SplittableTotalsShipmentConnectorToShipmentFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsShipmentConnector\Business\SplittableTotalsShipmentConnectorBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentFacadeMock = $this->getMockBuilder(SplittableTotalsShipmentConnectorToShipmentFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new SplittableTotalsShipmentConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateSplittedQuoteExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(SplittableTotalsShipmentConnectorDependencyProvider::FACADE_SHIPMENT)
            ->willReturn($this->shipmentFacadeMock);

        static::assertInstanceOf(
            SplittedQuoteExpander::class,
            $this->businessFactory->createSplittedQuoteExpander()
        );
    }
}
