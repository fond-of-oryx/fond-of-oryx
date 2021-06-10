<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCompanyUnitAddressConnector\Business\Mapper;

use Codeception\Test\Unit;
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
        $name1 = 'Foo';
        $name2 = 'Bar';

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getName1')
            ->willReturn($name1);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getName2')
            ->willReturn($name2);

        $addressTransfer = $this->addressMapper->fromCompanyUnitAddressTransfer($this->companyUnitAddressTransferMock);

        static::assertEquals(
            $name1,
            $addressTransfer->getFirstName()
        );

        static::assertEquals(
            $name2,
            $addressTransfer->getLastName()
        );
    }
}
