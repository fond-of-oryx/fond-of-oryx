<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\CountryTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class ReturnLabelRequestAddressMapperTest extends Unit
{
    protected MockObject|CompanyUnitAddressTransfer $companyUnitAddressTransferMock;

    protected MockObject|CountryTransfer $countryTransferMock;

    protected ReturnLabelRequestAddressMapperInterface $mapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUnitAddressTransferMock = $this->getMockBuilder(CompanyUnitAddressTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->countryTransferMock = $this->getMockBuilder(CountryTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->mapper = new ReturnLabelRequestAddressMapper();
    }

    /**
     * @return void
     */
    public function testFromCompanyUnitAddressTransfer(): void
    {
        $countryName = 'foo';

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getCountry')
            ->willReturn($this->countryTransferMock);

        $this->countryTransferMock->expects(static::atLeastOnce())
            ->method('getName')
            ->willReturn($countryName);

        $this->mapper->fromCompanyUnitAddressTransfer($this->companyUnitAddressTransferMock);
    }

    /**
     * @return void
     */
    public function testFromCompanyUnitAddressTransferWithoutCountry(): void
    {
        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        $this->companyUnitAddressTransferMock->expects(static::atLeastOnce())
            ->method('getCountry')
            ->willReturn(null);

        $this->mapper->fromCompanyUnitAddressTransfer($this->companyUnitAddressTransferMock);
    }
}
