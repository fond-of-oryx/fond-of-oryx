<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelCustomerTransfer;

class ReturnLabelCustomerMapperTest extends Unit
{
    /**
     * @var ReturnLabelAddressMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelAddressMapperMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var CompanyUnitAddressTransferr|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelCustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelCustomerTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelAddressTransferMock;

    /**
     * @var ReturnLabelCustomerMapperInterface
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->returnLabelAddressMapperMock = $this->getMockBuilder(ReturnLabelAddressMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelCustomerTransferMock = $this->getMockBuilder(ReturnLabelCustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelAddressTransferMock = $this->getMockBuilder(ReturnLabelAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new ReturnLabelCustomerMapper($this->returnLabelAddressMapperMock);
    }

    /**
     * @return void
     */
    public function testMapCompanyBusinessUnitToReturnLabelCustomer(): void
    {
        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getCompany')
            ->willReturn($this->companyTransferMock);

        $this->returnLabelCustomerTransferMock->expects(static::atLeastOnce())
            ->method('setReceiverId')
            ->willReturnSelf();

        $this->returnLabelCustomerTransferMock->expects(static::atLeastOnce())
            ->method('setCustomerReference')
            ->willReturnSelf();

        $this->returnLabelCustomerTransferMock->expects(static::atLeastOnce())
            ->method('setEmail')
            ->willReturnSelf();

        $this->returnLabelCustomerTransferMock->expects(static::atLeastOnce())
            ->method('setPhone')
            ->willReturnSelf();

        static::assertInstanceOf(
            ReturnLabelCustomerTransfer::class,
            $this->mapper->mapCompanyBusinessUnitToReturnLabelCustomer(
                $this->companyBusinessUnitTransferMock,
                $this->returnLabelCustomerTransferMock
            )
        );
    }

    /**
     * @return void
     */
    public function testMapCompanyUnitAddressToReturnLabelCustomer(): void
    {
        $this->returnLabelCustomerTransferMock->expects(static::atLeastOnce())
            ->method('setAddress')
            ->willReturnSelf();

        $this->returnLabelAddressMapperMock->expects(static::atLeastOnce())
            ->method('mapCompanyUnitAddressToReturnLabelAddress')
            ->willReturn($this->returnLabelAddressTransferMock);

        static::assertInstanceOf(
            ReturnLabelCustomerTransfer::class,
            $this->mapper->mapCompanyUnitAddressToReturnLabelCustomer(
                $this->companyUnitAddressTransferMock,
                $this->returnLabelCustomerTransferMock
            )
        );
    }
}
