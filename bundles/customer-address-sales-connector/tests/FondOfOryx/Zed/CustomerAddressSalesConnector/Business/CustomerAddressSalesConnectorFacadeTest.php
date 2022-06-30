<?php

namespace FondOfOryx\Zed\CustomerAddressSalesConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerAddressSalesConnector\Business\Writer\SalesOrderAddressWriterInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class CustomerAddressSalesConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerAddressSalesConnector\Business\CustomerAddressSalesConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerAddressSalesConnector\Business\Writer\SalesOrderAddressWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderAddressWriterMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerAddressSalesConnector\Business\CustomerAddressSalesConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CustomerAddressSalesConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderAddressWriterMock = $this->getMockBuilder(SalesOrderAddressWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CustomerAddressSalesConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testUpdateFkResourceCustomerAddressForSalesOrderAddress(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createSalesOrderAddressWriter')
            ->willReturn($this->salesOrderAddressWriterMock);

        $this->salesOrderAddressWriterMock->expects(static::atLeastOnce())
            ->method('updateFkResourceCustomerAddressByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facade->updateFkResourceCustomerAddressForSalesOrderAddress($this->quoteTransferMock),
        );
    }
}
