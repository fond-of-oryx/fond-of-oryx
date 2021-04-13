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
