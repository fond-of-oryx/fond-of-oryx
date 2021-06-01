<?php

namespace FondOfOryx\Zed\SplittableTotalsShipmentConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use Spryker\Zed\Shipment\Business\ShipmentFacadeInterface;

class SplittableTotalsShipmentConnectorToShipmentFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Shipment\Business\ShipmentFacadeInterface
     */
    protected $shipmentFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ShipmentMethodTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentMethodTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsShipmentConnector\Dependency\Facade\SplittableTotalsShipmentConnectorToShipmentFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->shipmentFacadeMock = $this->getMockBuilder(ShipmentFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentMethodTransferMock = $this->getMockBuilder(ShipmentMethodTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new SplittableTotalsShipmentConnectorToShipmentFacadeBridge(
            $this->shipmentFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testFindAvailableMethodById(): void
    {
        $idShipmentMethod = 1;

        $this->shipmentFacadeMock->expects(static::atLeastOnce())
            ->method('findAvailableMethodById')
            ->with($idShipmentMethod, $this->quoteTransferMock)
            ->willReturn($this->shipmentMethodTransferMock);

        static::assertEquals(
            $this->shipmentMethodTransferMock,
            $this->bridge->findAvailableMethodById($idShipmentMethod, $this->quoteTransferMock)
        );
    }
}
