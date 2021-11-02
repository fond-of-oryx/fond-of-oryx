<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business\Expander;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestShipmentTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class QuoteExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestShipmentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restShipmentTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiShipmentConnector\Business\Expander\QuoteExpander
     */
    protected $quoteExpander;

    /**
     * @var \Generated\Shared\Transfer\ShipmentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restShipmentTransferMock = $this->getMockBuilder(RestShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpander = new QuoteExpander();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $idShipmentMethod = 1;

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->restShipmentTransferMock);

        $this->restShipmentTransferMock->expects(static::atLeastOnce())
            ->method('getIdShipmentMethod')
            ->willReturn($idShipmentMethod);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('setMethod')
            ->with(
                static::callback(
                    static function (ShipmentMethodTransfer $shipmentMethodTransfer) use ($idShipmentMethod) {
                        return $shipmentMethodTransfer->getIdShipmentMethod() === $idShipmentMethod;
                    },
                ),
            )->willReturn($this->shipmentTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutRestShipment(): void
    {
        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::never())
            ->method('getShipment');

        $this->shipmentTransferMock->expects(static::never())
            ->method('setMethod');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutShipment(): void
    {
        $idShipmentMethod = 1;

        $this->restSplittableCheckoutRequestTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->restShipmentTransferMock);

        $this->restShipmentTransferMock->expects(static::atLeastOnce())
            ->method('getIdShipmentMethod')
            ->willReturn($idShipmentMethod);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock),
        );
    }
}
