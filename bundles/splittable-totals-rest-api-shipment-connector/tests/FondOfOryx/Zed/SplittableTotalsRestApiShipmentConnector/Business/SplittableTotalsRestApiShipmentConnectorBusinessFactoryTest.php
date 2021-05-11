<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Dependency\Facade\SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface;
use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\SplittableTotalsRestApiShipmentConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableTotalsRestApiShipmentConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Dependency\Facade\SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\SplittableTotalsRestApiShipmentConnectorBusinessFactory
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

        $this->shipmentFacadeMock = $this->getMockBuilder(SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new SplittableTotalsRestApiShipmentConnectorBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateQuoteExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(SplittableTotalsRestApiShipmentConnectorDependencyProvider::FACADE_SHIPMENT)
            ->willReturn($this->shipmentFacadeMock);

        static::assertInstanceOf(
            QuoteExpander::class,
            $this->businessFactory->createQuoteExpander()
        );
    }
}
