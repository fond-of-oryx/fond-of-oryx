<?php

namespace FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableQuoteShipmentConnector\Dependency\Facade\SplittableQuoteShipmentConnectorToShipmentFacadeInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\ExpenseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentMethodTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;
use Spryker\Shared\Shipment\ShipmentConfig;

class SplittedQuoteExpanderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Dependency\Facade\SplittableQuoteShipmentConnectorToShipmentFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableQuoteShipmentConnector\Business\Expander\SplittedQuoteExpander
     */
    protected $splittedQuoteExpander;

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

        $this->shipmentFacadeMock = $this->getMockBuilder(SplittableQuoteShipmentConnectorToShipmentFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
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

        $this->splittedQuoteExpander = new SplittedQuoteExpander($this->shipmentFacadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $idShipmentMethod = 1;
        $storeCurrencyPrice = 499;
        $self = $this;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('getMethod')
            ->willReturn($this->shipmentMethodTransferMock);

        $this->shipmentMethodTransferMock->expects(static::atLeastOnce())
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
                    },
                ),
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->splittedQuoteExpander->expand($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutShipment(): void
    {
        $this->quoteTransferMock->expects(static::once())
            ->method('getShipment')
            ->willReturn(null);

        $this->shipmentFacadeMock->expects(static::never())
            ->method('findAvailableMethodById');

        $this->shipmentTransferMock->expects(static::never())
            ->method('setMethod');

        $this->quoteTransferMock->expects(static::never())
            ->method('getShippingAddress');

        $this->quoteTransferMock->expects(static::never())
            ->method('addExpense');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->splittedQuoteExpander->expand($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutShipmentMethod(): void
    {
        $this->quoteTransferMock->expects(static::once())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('getMethod')
            ->willReturn(null);

        $this->shipmentFacadeMock->expects(static::never())
            ->method('findAvailableMethodById');

        $this->shipmentTransferMock->expects(static::never())
            ->method('setMethod');

        $this->quoteTransferMock->expects(static::never())
            ->method('getShippingAddress');

        $this->quoteTransferMock->expects(static::never())
            ->method('addExpense');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->splittedQuoteExpander->expand($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithNonExistingShippingMethod(): void
    {
        $idShipmentMethod = 1;

        $this->quoteTransferMock->expects(static::once())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('getMethod')
            ->willReturn($this->shipmentMethodTransferMock);

        $this->shipmentMethodTransferMock->expects(static::atLeastOnce())
            ->method('getIdShipmentMethod')
            ->willReturn($idShipmentMethod);

        $this->shipmentFacadeMock->expects(static::atLeastOnce())
            ->method('findAvailableMethodById')
            ->with($idShipmentMethod, $this->quoteTransferMock)
            ->willReturn(null);

        $this->shipmentTransferMock->expects(static::never())
            ->method('setMethod');

        $this->quoteTransferMock->expects(static::never())
            ->method('getShippingAddress');

        $this->quoteTransferMock->expects(static::never())
            ->method('addExpense');

        static::assertEquals(
            $this->quoteTransferMock,
            $this->splittedQuoteExpander->expand($this->quoteTransferMock),
        );
    }
}
