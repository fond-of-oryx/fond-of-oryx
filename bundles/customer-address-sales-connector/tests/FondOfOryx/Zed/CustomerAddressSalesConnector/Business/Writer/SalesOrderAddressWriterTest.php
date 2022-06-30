<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Business\Writer;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerAddressSalesConnector\Persistence\CustomerAddressSalesConnectorEntityManagerInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class SalesOrderAddressWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerAddressSalesConnector\Persistence\CustomerAddressSalesConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var array<\Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $addressTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\ShipmentTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $shipmentTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $itemTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerAddressSalesConnector\Business\Writer\SalesOrderAddressWriter
     */
    protected $salesOrderAddressWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CustomerAddressSalesConnectorEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressTransferMocks = [
            $this->getMockBuilder(AddressTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(AddressTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            ];

        $this->shipmentTransferMock = $this->getMockBuilder(ShipmentTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->itemTransferMock = $this->getMockBuilder(ItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderAddressWriter = new SalesOrderAddressWriter(
            $this->entityManagerMock,
        );
    }

    /**
     * @return void
     */
    public function testUpdateFkResourceCustomerAddressByQuote(): void
    {
        $idSalesOrderAddress = 2;
        $idCustomerAddress = 1;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->addressTransferMocks[0]);

        $this->addressTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderAddress')
            ->willReturn(1);

        $this->addressTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdCustomerAddress')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMocks[1]);

        $this->addressTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderAddress')
            ->willReturn($idSalesOrderAddress);

        $this->addressTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdCustomerAddress')
            ->willReturn($idCustomerAddress);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateFkResourceCustomerAddressForSalesOrderAddress')
            ->with($idSalesOrderAddress, $idCustomerAddress);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject([$this->itemTransferMock]));

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->salesOrderAddressWriter->updateFkResourceCustomerAddressByQuote($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateFkResourceCustomerAddressByQuoteWithMultiShipment(): void
    {
        $idSalesOrderAddress = 2;
        $idCustomerAddress = 1;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->addressTransferMocks[0]);

        $this->addressTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderAddress')
            ->willReturn(1);

        $this->addressTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdCustomerAddress')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject([$this->itemTransferMock]));

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn($this->shipmentTransferMock);

        $this->shipmentTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMocks[1]);

        $this->addressTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderAddress')
            ->willReturn($idSalesOrderAddress);

        $this->addressTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdCustomerAddress')
            ->willReturn($idCustomerAddress);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateFkResourceCustomerAddressForSalesOrderAddress')
            ->with($idSalesOrderAddress, $idCustomerAddress);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->salesOrderAddressWriter->updateFkResourceCustomerAddressByQuote($this->quoteTransferMock),
        );
    }
}
