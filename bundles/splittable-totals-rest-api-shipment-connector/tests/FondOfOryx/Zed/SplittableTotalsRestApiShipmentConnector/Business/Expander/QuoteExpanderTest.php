<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Dependency\Facade\SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\ExpenseTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestShipmentTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Laminas\Stdlib\ArrayObject;
use Spryker\Shared\Shipment\ShipmentConfig;

class QuoteExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Dependency\Facade\SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestShipmentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restShipmentTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ShipmentMethodTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentMethodTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApiShipmentConnector\Business\Expander\QuoteExpander
     */
    protected $quoteExpander;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $itemTransferMocks;

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

        $this->shipmentFacadeMock = $this->getMockBuilder(SplittableTotalsRestApiShipmentConnectorToShipmentFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restShipmentTransferMock = $this->getMockBuilder(RestShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentMethodTransferMock = $this->getMockBuilder(ShipmentMethodTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->quoteExpander = new QuoteExpander($this->shipmentFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $idShipmentMethod = 1;
        $storeCurrencyPrice = 499;
        $self = $this;

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->restShipmentTransferMock);

        $this->restShipmentTransferMock->expects(static::atLeastOnce())
            ->method('getIdShipmentMethod')
            ->willReturn($idShipmentMethod);

        $this->shipmentFacadeMock->expects(static::atLeastOnce())
            ->method('findAvailableMethodById')
            ->with($idShipmentMethod, $this->quoteTransferMock)
            ->willReturn($this->shipmentMethodTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('setMethod')
            ->with($this->shipmentMethodTransferMock)
            ->willReturn($this->shipmentTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('setMethod')
            ->with($this->shipmentMethodTransferMock)
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getIdShipmentMethod')
            ->willReturn($idShipmentMethod);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->shipmentMethodTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->shipmentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getStoreCurrencyPrice')
            ->willReturn($storeCurrencyPrice);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('addExpense')
            ->with(
                static::callback(
                    static function (ExpenseTransfer $expenseTransfer) use ($storeCurrencyPrice, $idShipmentMethod, $self) {
                        return $expenseTransfer->getType() === ShipmentConfig::SHIPMENT_EXPENSE_TYPE
                            && $expenseTransfer->getUnitNetPrice() === $storeCurrencyPrice
                            && $expenseTransfer->getUnitGrossPrice() === $storeCurrencyPrice
                            && $expenseTransfer->getQuantity() === 1
                            && $expenseTransfer->getShipment() !== null
                            && $expenseTransfer->getShipment()->getShipmentSelection() === (string)$idShipmentMethod
                            && $expenseTransfer->getShipment()->getMethod() === $self->shipmentMethodTransferMock
                            && $expenseTransfer->getShipment()->getShippingAddress() === $self->addressTransferMock;
                    }
                )
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->restSplittableTotalsRequestTransferMock, $this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutRestShipment(): void
    {
        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        $this->shipmentFacadeMock->expects(static::never())
            ->method('findAvailableMethodById');

        $this->quoteTransferMock->expects(static::never())
            ->method('getShipment');

        $this->quoteTransferMock->expects(static::never())
            ->method('getItems');

        $this->itemTransferMocks[0]->expects(static::never())
            ->method('getShipment');

        $this->shipmentTransferMock->expects(static::never())
            ->method('setMethod');

        $this->quoteTransferMock->expects(static::never())
            ->method('getShippingAddress');

        $this->quoteTransferMock->expects(static::never())
            ->method('addExpense');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->restSplittableTotalsRequestTransferMock, $this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithNonExistingShippingMethod(): void
    {
        $idShipmentMethod = 1;

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->restShipmentTransferMock);

        $this->restShipmentTransferMock->expects(static::atLeastOnce())
            ->method('getIdShipmentMethod')
            ->willReturn($idShipmentMethod);

        $this->shipmentFacadeMock->expects(static::atLeastOnce())
            ->method('findAvailableMethodById')
            ->with($idShipmentMethod, $this->quoteTransferMock)
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::never())
            ->method('getShipment');

        $this->quoteTransferMock->expects(static::never())
            ->method('getItems');

        $this->itemTransferMocks[0]->expects(static::never())
            ->method('getShipment');

        $this->shipmentTransferMock->expects(static::never())
            ->method('setMethod');

        $this->quoteTransferMock->expects(static::never())
            ->method('getShippingAddress');

        $this->quoteTransferMock->expects(static::never())
            ->method('addExpense');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->restSplittableTotalsRequestTransferMock, $this->quoteTransferMock)
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutShipment(): void
    {
        $idShipmentMethod = 1;
        $storeCurrencyPrice = 499;
        $self = $this;

        $this->restSplittableTotalsRequestTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->restShipmentTransferMock);

        $this->restShipmentTransferMock->expects(static::atLeastOnce())
            ->method('getIdShipmentMethod')
            ->willReturn($idShipmentMethod);

        $this->shipmentFacadeMock->expects(static::atLeastOnce())
            ->method('findAvailableMethodById')
            ->with($idShipmentMethod, $this->quoteTransferMock)
            ->willReturn($this->shipmentMethodTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        $this->itemTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        $this->shipmentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getIdShipmentMethod')
            ->willReturn($idShipmentMethod);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMock);

        $this->shipmentMethodTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->shipmentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getStoreCurrencyPrice')
            ->willReturn($storeCurrencyPrice);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('addExpense')
            ->with(
                static::callback(
                    static function (ExpenseTransfer $expenseTransfer) use ($storeCurrencyPrice, $idShipmentMethod, $self) {
                        return $expenseTransfer->getType() === ShipmentConfig::SHIPMENT_EXPENSE_TYPE
                            && $expenseTransfer->getUnitNetPrice() === $storeCurrencyPrice
                            && $expenseTransfer->getUnitGrossPrice() === $storeCurrencyPrice
                            && $expenseTransfer->getQuantity() === 1
                            && $expenseTransfer->getShipment() !== null
                            && $expenseTransfer->getShipment()->getShipmentSelection() === (string)$idShipmentMethod
                            && $expenseTransfer->getShipment()->getMethod() === $self->shipmentMethodTransferMock
                            && $expenseTransfer->getShipment()->getShippingAddress() === $self->addressTransferMock;
                    }
                )
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->restSplittableTotalsRequestTransferMock, $this->quoteTransferMock)
        );
    }
}
