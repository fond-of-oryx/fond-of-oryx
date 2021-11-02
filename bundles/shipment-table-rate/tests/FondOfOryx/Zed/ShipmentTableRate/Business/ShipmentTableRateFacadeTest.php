<?php

namespace FondOfOryx\Zed\ShipmentTableRate\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ShipmentTableRate\Business\Model\PriceCalculatorInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentGroupTransfer;

class ShipmentTableRateFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\Business\ShipmentTableRateBusinessFactory
     */
    protected $shipmentTableRateBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ShipmentGroupTransfer
     */
    protected $shipmentGroupTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ShipmentTableRate\Business\Model\PriceCalculatorInterface
     */
    protected $priceCalculatorMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentTableRate\Business\ShipmentTableRateFacade
     */
    protected $shipmentTableRateFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->shipmentTableRateBusinessFactoryMock = $this->getMockBuilder(ShipmentTableRateBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentGroupTransferMock = $this->getMockBuilder(ShipmentGroupTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceCalculatorMock = $this->getMockBuilder(PriceCalculatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTableRateFacade = new ShipmentTableRateFacade();
        $this->shipmentTableRateFacade->setFactory($this->shipmentTableRateBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testCalculatePrice(): void
    {
        $price = 495;

        $this->shipmentTableRateBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createPriceCalculator')
            ->willReturn($this->priceCalculatorMock);

        $this->priceCalculatorMock->expects($this->atLeastOnce())
            ->method('calculate')
            ->with(
                $this->quoteTransferMock,
                $this->shipmentGroupTransferMock,
            )->willReturn($price);

        $this->assertEquals(
            $price,
            $this->shipmentTableRateFacade->calculatePrice(
                $this->quoteTransferMock,
                $this->shipmentGroupTransferMock,
            ),
        );
    }
}
