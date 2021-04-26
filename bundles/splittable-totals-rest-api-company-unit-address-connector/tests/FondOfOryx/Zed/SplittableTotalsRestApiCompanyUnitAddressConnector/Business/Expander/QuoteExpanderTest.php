<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Expander;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Generated\Shared\Transfer\SplittableTotalsRequestTransfer;

class QuoteExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Reader\CompanyUnitAddressReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressReaderMock;

    /**
     * @var \Generated\Shared\Transfer\SplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $itemTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\ShipmentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiCompanyUnitAddressConnector\Business\Expander\QuoteExpander
     */
    protected $quoteExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressReaderMock = $this->getMockBuilder(CompanyUnitAddressReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableTotalsRequestTransferMock = $this->getMockBuilder(SplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [$this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock()];

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpander = new QuoteExpander($this->companyUnitAddressReaderMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getBillingAddressBySplittableTotalsRequestTransfer')
            ->with($this->splittableTotalsRequestTransferMock)
            ->willReturn($this->addressTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setBillingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->quoteTransferMock);

        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getShippingAddressBySplittableTotalsRequestTransfer')
            ->with($this->splittableTotalsRequestTransferMock)
            ->willReturn($this->addressTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('setShippingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->shipmentTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setShippingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->addressTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setBillingSameAsShipping')
            ->with(true)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->splittableTotalsRequestTransferMock, $this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutAddresses(): void
    {
        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getBillingAddressBySplittableTotalsRequestTransfer')
            ->with($this->splittableTotalsRequestTransferMock)
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::never())
            ->method('setBillingAddress');

        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getShippingAddressBySplittableTotalsRequestTransfer')
            ->with($this->splittableTotalsRequestTransferMock)
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::never())
            ->method('getShipment');

        $this->quoteTransferMock->expects(static::never())
            ->method('setShippingAddress');

        $this->quoteTransferMock->expects(static::never())
            ->method('getItems');

        $this->itemTransferMocks[0]->expects(static::never())
            ->method('getShipment');

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setBillingSameAsShipping')
            ->with(false)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->splittableTotalsRequestTransferMock, $this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutItemShipment(): void
    {
        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getBillingAddressBySplittableTotalsRequestTransfer')
            ->with($this->splittableTotalsRequestTransferMock)
            ->willReturn($this->addressTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setBillingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->quoteTransferMock);

        $this->companyUnitAddressReaderMock->expects(static::atLeastOnce())
            ->method('getShippingAddressBySplittableTotalsRequestTransfer')
            ->with($this->splittableTotalsRequestTransferMock)
            ->willReturn($this->addressTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('setShippingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->shipmentTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setShippingAddress')
            ->with($this->addressTransferMock)
            ->willReturn($this->quoteTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->addressTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setBillingSameAsShipping')
            ->with(true)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->splittableTotalsRequestTransferMock, $this->quoteTransferMock)
        );
    }
}
