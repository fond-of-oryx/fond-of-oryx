<?php

namespace FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class OmsOrderMailExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\AddressExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressExpanderMock;

    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ShipmentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressTransferMock;

    /**
     * @var \FondOfOryx\Zed\CountryOmsMailConnector\Business\Expander\OmsOrderMailExpander
     */
    protected $omsOrderMailExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->addressExpanderMock = $this->getMockBuilder(AddressExpanderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->omsOrderMailExpander = new OmsOrderMailExpander($this->addressExpanderMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->addressTransferMock);

        $this->addressExpanderMock->expects(static::exactly(2))
            ->method('expand')
            ->with($this->addressTransferMock)
            ->willReturn($this->addressTransferMock);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('setBillingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->orderTransferMock);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn(null);

        $this->orderTransferMock->expects(static::never())
            ->method('setShippingAddress');

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject([$this->itemTransferMock]));

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('setShippingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->shipmentTransferMock);

        static::assertEquals(
            $this->mailTransferMock,
            $this->omsOrderMailExpander->expand(
                $this->mailTransferMock,
                $this->orderTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutBillingAddress(): void
    {
        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn(null);

        $this->addressExpanderMock->expects(static::once())
            ->method('expand')
            ->with($this->addressTransferMock)
            ->willReturn($this->addressTransferMock);

        $this->orderTransferMock->expects(static::never())
            ->method('setBillingAddress');

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn(null);

        $this->orderTransferMock->expects(static::never())
            ->method('setShippingAddress');

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject([$this->itemTransferMock]));

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('setShippingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->shipmentTransferMock);

        static::assertEquals(
            $this->mailTransferMock,
            $this->omsOrderMailExpander->expand(
                $this->mailTransferMock,
                $this->orderTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutShipmentOnItemLevel(): void
    {
        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->addressTransferMock);

        $this->addressExpanderMock->expects(static::exactly(2))
            ->method('expand')
            ->with($this->addressTransferMock)
            ->willReturn($this->addressTransferMock);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('setBillingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->orderTransferMock);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('setShippingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->orderTransferMock);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject([$this->itemTransferMock]));

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        static::assertEquals(
            $this->mailTransferMock,
            $this->omsOrderMailExpander->expand(
                $this->mailTransferMock,
                $this->orderTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutShippingAddressOnItemLevel(): void
    {
        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->addressTransferMock);

        $this->addressExpanderMock->expects(static::exactly(2))
            ->method('expand')
            ->with($this->addressTransferMock)
            ->willReturn($this->addressTransferMock);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('setBillingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->orderTransferMock);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('setShippingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->orderTransferMock);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject([$this->itemTransferMock]));

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn(null);

        $this->shipmentTransferMock->expects(static::never())
            ->method('setShippingAddress');

        static::assertEquals(
            $this->mailTransferMock,
            $this->omsOrderMailExpander->expand(
                $this->mailTransferMock,
                $this->orderTransferMock,
            ),
        );
    }
}
