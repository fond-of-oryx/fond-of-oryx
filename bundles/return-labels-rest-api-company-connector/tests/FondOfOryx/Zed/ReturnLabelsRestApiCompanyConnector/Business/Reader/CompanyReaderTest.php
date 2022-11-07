<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\ReturnLabelsRestApiCompanyConnectorRepository;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\RestCustomerTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

class CompanyReaderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCustomerTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Persistence\ReturnLabelsRestApiCompanyConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelsRestApiCompanyConnectorRepositoryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Reader\CompanyReader
     */
    protected $companyReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCustomerTransferMock = $this->getMockBuilder(RestCustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelsRestApiCompanyConnectorRepositoryMock = $this
            ->getMockBuilder(ReturnLabelsRestApiCompanyConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyReader = new CompanyReader($this->returnLabelsRestApiCompanyConnectorRepositoryMock);
    }

    /**
     * @return void
     */
    public function testGetByRestReturnLabelRequestSuccess(): void
    {
        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->restCustomerTransferMock);

        $this->restCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(666);

        $this->returnLabelsRestApiCompanyConnectorRepositoryMock->expects(static::atLeastOnce())
            ->method('getCompanyByIdCustomer')
            ->with(666)
            ->willReturn($this->companyTransferMock);

        static::assertInstanceOf(CompanyTransfer::class, $this->companyReader->getByRestReturnLabelRequest(
            $this->restReturnLabelRequestTransferMock,
        ));
    }

    /**
     * @return void
     */
    public function testGetByRestReturnLabelRequestFailedNoCustomer(): void
    {
        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        static::assertNull($this->companyReader->getByRestReturnLabelRequest(
            $this->restReturnLabelRequestTransferMock,
        ));
    }

    /**
     * @return void
     */
    public function testGetByRestReturnLabelRequestFailedCompanyNotFound(): void
    {
        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->restCustomerTransferMock);

        $this->restCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(666);

        $this->returnLabelsRestApiCompanyConnectorRepositoryMock->expects(static::atLeastOnce())
            ->method('getCompanyByIdCustomer')
            ->with(666)
            ->willReturn(null);

        static::assertNull($this->companyReader->getByRestReturnLabelRequest(
            $this->restReturnLabelRequestTransferMock,
        ));
    }
}
