<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\Writer\SalesOrderAddressWriterInterface;
use Generated\Shared\Transfer\QuoteTransfer;

class CompanyUnitAddressSalesConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\CompanyUnitAddressSalesConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\Writer\SalesOrderAddressWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $salesOrderAddressWriterMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\CompanyUnitAddressSalesConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CompanyUnitAddressSalesConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesOrderAddressWriterMock = $this->getMockBuilder(SalesOrderAddressWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyUnitAddressSalesConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testUpdateFkResourceCompanyUnitAddressForSalesOrderAddress(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createSalesOrderAddressWriter')
            ->willReturn($this->salesOrderAddressWriterMock);

        $this->salesOrderAddressWriterMock->expects(static::atLeastOnce())
            ->method('updateFkResourceCompanyUnitAddressByQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->facade->updateFkResourceCompanyUnitAddressForSalesOrderAddress($this->quoteTransferMock),
        );
    }
}
