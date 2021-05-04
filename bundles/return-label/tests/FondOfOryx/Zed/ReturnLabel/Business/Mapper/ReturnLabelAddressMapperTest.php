<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelAddressTransfer;

class ReturnLabelAddressMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Mapper\ReturnLabelAddressMapperInterface
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelAddressTransferMock = $this->getMockBuilder(ReturnLabelAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new ReturnLabelAddressMapper();
    }

    /**
     * @return void
     */
    public function testMapCompanyUnitAddressToReturnLabelAddress(): void
    {
        $this->returnLabelAddressTransferMock->expects(static::atLeastOnce())
            ->method('setName1')
            ->willReturn($this->returnLabelAddressTransferMock);

        $this->returnLabelAddressTransferMock->expects(static::atLeastOnce())
            ->method('setName2')
            ->willReturn($this->returnLabelAddressTransferMock);

        $this->returnLabelAddressTransferMock->expects(static::atLeastOnce())
            ->method('setAddress1')
            ->willReturn($this->returnLabelAddressTransferMock);

        $this->returnLabelAddressTransferMock->expects(static::atLeastOnce())
            ->method('setAddress2')
            ->willReturn($this->returnLabelAddressTransferMock);

        $this->returnLabelAddressTransferMock->expects(static::atLeastOnce())
            ->method('setAddress3')
            ->willReturn($this->returnLabelAddressTransferMock);

        $this->returnLabelAddressTransferMock->expects(static::atLeastOnce())
            ->method('setZipCode')
            ->willReturn($this->returnLabelAddressTransferMock);

        $this->returnLabelAddressTransferMock->expects(static::atLeastOnce())
            ->method('setCity')
            ->willReturn($this->returnLabelAddressTransferMock);

        $this->returnLabelAddressTransferMock->expects(static::atLeastOnce())
            ->method('setCountry')
            ->willReturn($this->returnLabelAddressTransferMock);

        $this->returnLabelAddressTransferMock->expects(static::atLeastOnce())
            ->method('setIso3Code')
            ->willReturnSelf();

        $response = $this->mapper->mapCompanyUnitAddressToReturnLabelAddress(
            $this->companyUnitAddressTransferMock,
            $this->returnLabelAddressTransferMock
        );

        static::assertInstanceOf(
            ReturnLabelAddressTransfer::class,
            $response
        );
    }
}
