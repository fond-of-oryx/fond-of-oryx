<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\AddressTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;

class AddressMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Mapper\AddressMapper
     */
    protected $addressMapper;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->addressMapper = new AddressMapper();
    }

    /**
     * @return void
     */
    public function testFromCompanyUnitAddressTransfer(): void
    {
        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        static::assertInstanceOf(
            AddressTransfer::class,
            $this->addressMapper->fromCompanyUnitAddressTransfer($this->companyUnitAddressTransferMock)
        );
    }
}
