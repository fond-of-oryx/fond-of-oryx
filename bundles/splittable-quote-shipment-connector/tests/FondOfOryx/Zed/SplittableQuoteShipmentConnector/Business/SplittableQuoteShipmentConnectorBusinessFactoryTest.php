<?php

namespace FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\Expander\SplittedQuoteExpander;
use FondOfOryx\Zed\SplittableQuoteShipmentConnector\Dependency\Facade\SplittableQuoteShipmentConnectorToShipmentFacadeInterface;
use FondOfOryx\Zed\SplittableQuoteShipmentConnector\SplittableQuoteShipmentConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SplittableQuoteShipmentConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Dependency\Facade\SplittableQuoteShipmentConnectorToShipmentFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\SplittableQuoteShipmentConnectorBusinessFactory
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

        $this->shipmentFacadeMock = $this->getMockBuilder(SplittableQuoteShipmentConnectorToShipmentFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new SplittableQuoteShipmentConnectorBusinessFactory();
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
            ->with(SplittableQuoteShipmentConnectorDependencyProvider::FACADE_SHIPMENT)
            ->willReturn($this->shipmentFacadeMock);

        static::assertInstanceOf(
            SplittedQuoteExpander::class,
            $this->businessFactory->createSplittedQuoteExpander()
        );
    }
}
