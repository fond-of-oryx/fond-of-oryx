<?php

namespace FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress;
use Orm\Zed\Country\Persistence\SpyCountry;

class CompanyUnitAddressMapperTest extends Unit
{
    /**
     * @var \Orm\Zed\CompanyUnitAddress\Persistence\SpyCompanyUnitAddress|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCompanyUnitAddressMock;

    /**
     * @var \Orm\Zed\Country\Persistence\SpyCountry|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCountryMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUnitAddressTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUnitAddressTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Persistence\Propel\Mapper\CompanyUnitAddressMapper
     */
    protected $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->spyCompanyUnitAddressMock = $this->getMockBuilder(SpyCompanyUnitAddress::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCountryMock = $this->getMockBuilder(SpyCountry::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new CompanyUnitAddressMapper();
    }

    /**
     * @return void
     */
    public function testMapEntityToTransfer(): void
    {
        $this->spyCompanyUnitAddressMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->spyCompanyUnitAddressMock->expects(static::atLeastOnce())
            ->method('getCountry')
            ->willReturn($this->spyCountryMock);

        $this->spyCountryMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->willReturn($this->companyUnitAddressTransferMock);

        static::assertEquals(
            $this->companyUnitAddressTransferMock,
            $this->mapper->mapEntityToTransfer($this->spyCompanyUnitAddressMock, $this->companyUnitAddressTransferMock)
        );
    }
}
