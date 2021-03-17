<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ShipmentTableRate\ShipmentTableRateConstants;
use FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentGroupTransfer;
use Generated\Shared\Transfer\ShipmentTableRateTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class PriceCalculatorTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\Business\Model\ShipmentTableRateReaderInterface
     */
    protected $shipmentTableRateReaderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\ShipmentTableRateConfig
     */
    protected $shipmentTableRateConfigMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ShipmentTableRateTransfer
     */
    protected $shipmentTableRateTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ShipmentGroupTransfer
     */
    protected $shipmentGroupTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ShipmentTransfer
     */
    protected $shipmentTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Business\Model\PriceCalculator
     */
    protected $priceCalculator;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->shipmentTableRateReaderMock = $this->getMockBuilder(ShipmentTableRateReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateConfigMock = $this->getMockBuilder(ShipmentTableRateConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateTransferMock = $this->getMockBuilder(ShipmentTableRateTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentGroupTransferMock = $this->getMockBuilder(ShipmentGroupTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceCalculator = new PriceCalculator(
            $this->shipmentTableRateReaderMock,
            $this->shipmentTableRateConfigMock
        );
    }

    /**
     * @return void
     */
    public function testCalculate(): void
    {
        $expectedPrice = 495;

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentGroupTransferMock->expects($this->atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTableRateConfigMock->expects($this->never())
            ->method('getFallbackPrice');

        $this->shipmentTableRateReaderMock->expects($this->atLeastOnce())
            ->method('getByShipmentAndQuote')
            ->with($this->shipmentTransferMock, $this->quoteTransferMock)
            ->willReturn($this->shipmentTableRateTransferMock);

        $this->shipmentTableRateTransferMock->expects($this->atLeastOnce())
            ->method('getPrice')
            ->willReturn($expectedPrice);

        $price = $this->priceCalculator->calculate($this->quoteTransferMock, $this->shipmentGroupTransferMock);

        $this->assertEquals($expectedPrice, $price);
    }

    /**
     * @return void
     */
    public function testCalculateWithoutShipmentGroup(): void
    {
        $expectedPrice = 495;

        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentGroupTransferMock->expects($this->never())
            ->method('getShipment');

        $this->shipmentTableRateReaderMock->expects($this->atLeastOnce())
            ->method('getByShipmentAndQuote')
            ->with($this->shipmentTransferMock, $this->quoteTransferMock)
            ->willReturn($this->shipmentTableRateTransferMock);

        $this->shipmentTableRateTransferMock->expects($this->atLeastOnce())
            ->method('getPrice')
            ->willReturn($expectedPrice);

        $price = $this->priceCalculator->calculate($this->quoteTransferMock, null);

        $this->assertEquals($expectedPrice, $price);
    }

    /**
     * @return void
     */
    public function testCalculateWithoutShipment(): void
    {
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        $this->shipmentGroupTransferMock->expects($this->atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        $this->shipmentTableRateConfigMock->expects($this->atLeastOnce())
            ->method('getFallbackPrice')
            ->willReturn(ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE);

        $this->shipmentTableRateReaderMock->expects($this->never())
            ->method('getByShipmentAndQuote');

        $this->shipmentTableRateTransferMock->expects($this->never())
            ->method('getPrice');

        $price = $this->priceCalculator->calculate($this->quoteTransferMock, $this->shipmentGroupTransferMock);

        $this->assertEquals(ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE, $price);
    }

    /**
     * @return void
     */
    public function testCalculateWithoutShipmentTableRate(): void
    {
        $this->quoteTransferMock->expects($this->atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentGroupTransferMock->expects($this->atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTableRateReaderMock->expects($this->atLeastOnce())
            ->method('getByShipmentAndQuote')
            ->with($this->shipmentTransferMock, $this->quoteTransferMock)
            ->willReturn(null);

        $this->shipmentTableRateConfigMock->expects($this->atLeastOnce())
            ->method('getFallbackPrice')
            ->willReturn(ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE);

        $this->shipmentTableRateTransferMock->expects($this->never())
            ->method('getPrice');

        $price = $this->priceCalculator->calculate($this->quoteTransferMock, $this->shipmentGroupTransferMock);

        $this->assertEquals(ShipmentTableRateConstants::FALLBACK_PRICE_DEFAULT_VALUE, $price);
    }
}
