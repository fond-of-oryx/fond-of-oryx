<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;

class RestCompanyBusinessUnitAddressSearchSortMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitAddressListTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchSortMapper
     */
    protected $restCompanyBusinessUnitAddressSearchSortMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(CompanyBusinessUnitAddressSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitAddressListTransferMock = $this->getMockBuilder(CompanyBusinessUnitAddressListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchSortMapper = new RestCompanyBusinessUnitAddressSearchSortMapper($this->configMock);
    }

    /**
     * @return void
     */
    public function testFromCompanyList(): void
    {
        $sortParamNames = ['name_asc', 'name_desc'];
        $sortParamLocalizedNames = ['companies_rest_api.sort.name_asc', 'companies_rest_api.sort.name_desc'];
        $sortFields = ['name'];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamNames')
            ->willReturn($sortParamNames);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($sortParamLocalizedNames);

        $this->companyBusinessUnitAddressListTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($sortParamNames[0]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortFields')
            ->willReturn($sortFields);

        $restCompanyBusinessUnitAddressSearchSortTransfer = $this->restCompanyBusinessUnitAddressSearchSortMapper->fromCompanyBusinessUnitAddressList(
            $this->companyBusinessUnitAddressListTransferMock
        );

        static::assertEquals('asc', $restCompanyBusinessUnitAddressSearchSortTransfer->getCurrentSortOrder());
        static::assertEquals($sortParamNames[0], $restCompanyBusinessUnitAddressSearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restCompanyBusinessUnitAddressSearchSortTransfer->getSortParamNames());
        static::assertEquals($sortParamLocalizedNames, $restCompanyBusinessUnitAddressSearchSortTransfer->getSortParamLocalizedNames());
    }
}
