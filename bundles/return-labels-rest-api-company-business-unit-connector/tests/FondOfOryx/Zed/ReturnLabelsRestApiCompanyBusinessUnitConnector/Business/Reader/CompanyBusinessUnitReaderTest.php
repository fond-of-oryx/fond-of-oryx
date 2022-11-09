<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\ReturnLabelsRestApiCompanyBusinessUnitConnectorRepository;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\RestCustomerTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

class CompanyBusinessUnitReaderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCustomerTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Persistence\ReturnLabelsRestApiCompanyBusinessUnitConnectorRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Reader\CompanyBusinessUnitReader
     */
    protected $companyBusinessUnitReader;

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

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this
            ->getMockBuilder(ReturnLabelsRestApiCompanyBusinessUnitConnectorRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitReader = new CompanyBusinessUnitReader($this->repositoryMock);
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

        $this->restCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getReference')
            ->willReturn('companyUserReference');

        $this->repositoryMock->expects(static::atLeastOnce())
            ->method('getCompanyBusinessUnitByCompanyUserReferenceAndIdCustomer')
            ->with('companyUserReference', 666)
            ->willReturn($this->companyBusinessUnitTransferMock);

        $companyBusinessUnitTransfer = $this->companyBusinessUnitReader->getByRestReturnLabelRequest(
            $this->restReturnLabelRequestTransferMock,
        );

        static::assertEquals($companyBusinessUnitTransfer, $this->companyBusinessUnitTransferMock);
    }

    /**
     * @return void
     */
    public function testGetByRestReturnLabelRequestFailedNoCustomer(): void
    {
        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn(null);

        $this->repositoryMock->expects(static::never())
            ->method('getCompanyBusinessUnitByCompanyUserReferenceAndIdCustomer');

        $companyBusinessUnitTransfer = $this->companyBusinessUnitReader->getByRestReturnLabelRequest(
            $this->restReturnLabelRequestTransferMock,
        );

        static::assertEquals(null, $companyBusinessUnitTransfer);
    }

    /**
     * @return void
     */
    public function testGetByRestReturnLabelRequestFailedNoIdCustomer(): void
    {
        $this->restReturnLabelRequestTransferMock->expects(static::atLeastOnce())
            ->method('getCustomer')
            ->willReturn($this->restCustomerTransferMock);

        $this->restCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getIdCustomer')
            ->willReturn(null);

        $this->restCustomerTransferMock->expects(static::atLeastOnce())
            ->method('getReference')
            ->willReturn('companyUserReference');

        $this->repositoryMock->expects(static::never())
            ->method('getCompanyBusinessUnitByCompanyUserReferenceAndIdCustomer');

        $companyBusinessUnitTransfer = $this->companyBusinessUnitReader->getByRestReturnLabelRequest(
            $this->restReturnLabelRequestTransferMock,
        );

        static::assertEquals(null, $companyBusinessUnitTransfer);
    }
}
