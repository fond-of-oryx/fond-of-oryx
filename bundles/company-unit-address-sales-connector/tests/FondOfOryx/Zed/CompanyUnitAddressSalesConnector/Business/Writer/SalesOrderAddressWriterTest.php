<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\Writer;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Persistence\CompanyUnitAddressSalesConnectorEntityManagerInterface;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\ShipmentTransfer;

class SalesOrderAddressWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Persistence\CompanyUnitAddressSalesConnectorEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
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
     * @var \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\Writer\SalesOrderAddressWriter
     */
    protected $salesOrderAddressWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CompanyUnitAddressSalesConnectorEntityManagerInterface::class)
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
    public function testUpdateFkResourceCompanyUnitAddressByQuote(): void
    {
        $idSalesOrderAddress = 2;
        $idCompanyUnitAddress = 1;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->addressTransferMocks[0]);

        $this->addressTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderAddress')
            ->willReturn(1);

        $this->addressTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdCustomerAddress')
            ->willReturn(1);

        $this->addressTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn(null);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getShippingAddress')
            ->willReturn($this->addressTransferMocks[1]);

        $this->addressTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderAddress')
            ->willReturn($idSalesOrderAddress);

        $this->addressTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdCustomerAddress')
            ->willReturn(null);

        $this->addressTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn($idCompanyUnitAddress);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateFkResourceCompanyUnitAddressForSalesOrderAddress')
            ->with($idSalesOrderAddress, $idCompanyUnitAddress);

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getItems')
            ->willReturn(new ArrayObject([$this->itemTransferMock]));

        $this->itemTransferMock->expects(static::atLeastOnce())
            ->method('getShipment')
            ->willReturn(null);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->salesOrderAddressWriter->updateFkResourceCompanyUnitAddressByQuote($this->quoteTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateFkResourceCompanyUnitAddressByQuoteWithMultiShipment(): void
    {
        $idSalesOrderAddress = 2;
        $idCompanyUnitAddress = 1;

        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('getBillingAddress')
            ->willReturn($this->addressTransferMocks[0]);

        $this->addressTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdSalesOrderAddress')
            ->willReturn(1);

        $this->addressTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdCustomerAddress')
            ->willReturn(1);

        $this->addressTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
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
            ->willReturn(null);

        $this->addressTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getIdCompanyUnitAddress')
            ->willReturn($idCompanyUnitAddress);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateFkResourceCompanyUnitAddressForSalesOrderAddress')
            ->with($idSalesOrderAddress, $idCompanyUnitAddress);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->salesOrderAddressWriter->updateFkResourceCompanyUnitAddressByQuote($this->quoteTransferMock),
        );
    }
}
