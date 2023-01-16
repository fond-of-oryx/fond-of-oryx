<?php

namespace FondOfOryx\Zed\MailjetMailConnector\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\AddressTransfer;

class MailjetTemplateVariablesAddressMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $addressTransferMock;

    /**
     * @var \FondOfOryx\Zed\MailjetMailConnector\Business\Mapper\MailjetTemplateVariablesAddressMapper
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->addressTransferMock = $this->getMockBuilder(AddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new MailjetTemplateVariablesAddressMapper();
    }

    /**
     * @return void
     */
    public function testMap(): void
    {
        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getCompany')
            ->willReturn('Company');

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getFirstName')
            ->willReturn('FirstName');

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getLastName')
            ->willReturn('LastName');

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn('E-Mail');

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getAddress1')
            ->willReturn('Address 1');

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getAddress2')
            ->willReturn('Address 2');

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getAddress3')
            ->willReturn('Address 3');

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getZipCode')
            ->willReturn('Zip Code');

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getCity')
            ->willReturn('City');

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getIso2Code')
            ->willReturn('ISO 2 CODE');

        $this->addressTransferMock->expects(static::atLeastOnce())
            ->method('getRegion')
            ->willReturn('Region');

        static::assertCount(11, $this->mapper->map($this->addressTransferMock));
    }
}
