<?php

namespace FondOfOryx\Zed\ShipmentCartCodeConnector\Business\Sanitizer;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\ExpenseTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class ShipmentSanitizerTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $itemTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\ExpenseTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $expenseTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\ShipmentTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $shipmentTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\ExpenseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentTransferMock;

    /**
     * @var \FondOfOryx\Zed\ShipmentCartCodeConnector\Business\Sanitizer\ShipmentSanitizer
     */
    protected $shipmentSanitizer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMocks = [
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->expenseTransferMocks = [
            $this->getMockBuilder(ExpenseTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ExpenseTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->shipmentTransferMocks = [
            $this->getMockBuilder(ShipmentTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(ShipmentTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->shipmentSanitizer = new ShipmentSanitizer();
    }

    /**
     * @return void
     */
    public function testSanitize(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('setMethod')
            ->with(null)
            ->willReturn($this->shipmentTransferMock);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject($this->itemTransferMocks));

        foreach ($this->itemTransferMocks as $index => $itemTransferMock) {
            $itemTransferMock->expects(static::atLeastOnce())
                ->method('getShipment')
                ->willReturn($this->shipmentTransferMocks[$index]);

            $this->shipmentTransferMocks[$index]->expects(static::atLeastOnce())
                ->method('setMethod')
                ->with(null)
                ->willReturn($this->shipmentTransferMocks[$index]);
        }

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getExpenses')
            ->willReturn(new ArrayObject($this->expenseTransferMocks));

        foreach ($this->expenseTransferMocks as $index => $expenseTransferMock) {
            $expenseTransferMock->expects(static::atLeastOnce())
                ->method('getType')
                ->willReturn($index === 1 ? 'SHIPMENT_EXPENSE_TYPE' : 'FOO_EXPENSE_TYPE');
        }

        $expenseTransferMock = $this->expenseTransferMocks[0];

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setExpenses')
            ->with(
                static::callback(
                    static function (ArrayObject $expenseTransfers) use ($expenseTransferMock) {
                        return $expenseTransfers->count() === 1
                            && $expenseTransfers->offsetGet(0) === $expenseTransferMock;
                    }
                )
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->shipmentSanitizer->sanitize($this->quoteTransferMock)
        );
    }
}
