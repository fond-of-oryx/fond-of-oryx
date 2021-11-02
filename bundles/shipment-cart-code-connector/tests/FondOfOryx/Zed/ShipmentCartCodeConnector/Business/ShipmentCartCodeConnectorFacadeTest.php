<?php

namespace FondOfOryx\Zed\ShipmentCartCodeConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ShipmentCartCodeConnector\Business\Sanitizer\ShipmentSanitizerInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class ShipmentCartCodeConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ShipmentCartCodeConnector\Business\ShipmentCartCodeConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentCartCodeConnector\Business\Sanitizer\ShipmentSanitizerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentSanitizerMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentCartCodeConnector\Business\ShipmentCartCodeConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(ShipmentCartCodeConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentSanitizerMock = $this->getMockBuilder(ShipmentSanitizerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ShipmentCartCodeConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testSanitizeShipment(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createShipmentSanitizer')
            ->willReturn($this->shipmentSanitizerMock);

        $this->shipmentSanitizerMock->expects(static::atLeastOnce())
            ->method('sanitize')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facade->sanitizeShipment($this->quoteTransferMock),
        );
    }
}
