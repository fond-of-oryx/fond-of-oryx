<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;

class RestCompanyBusinessUnitSearchSortMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitListTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchSortMapper
     */
    protected $restCompanyBusinessUnitSearchSortMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(CompanyBusinessUnitSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitListTransferMock = $this->getMockBuilder(CompanyBusinessUnitListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitSearchSortMapper = new RestCompanyBusinessUnitSearchSortMapper($this->configMock);
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

        $this->companyBusinessUnitListTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($sortParamNames[0]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortFields')
            ->willReturn($sortFields);

        $restCompanyBusinessUnitSearchSortTransfer = $this->restCompanyBusinessUnitSearchSortMapper->fromCompanyBusinessUnitList(
            $this->companyBusinessUnitListTransferMock
        );

        static::assertEquals('asc', $restCompanyBusinessUnitSearchSortTransfer->getCurrentSortOrder());
        static::assertEquals($sortParamNames[0], $restCompanyBusinessUnitSearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restCompanyBusinessUnitSearchSortTransfer->getSortParamNames());
        static::assertEquals($sortParamLocalizedNames, $restCompanyBusinessUnitSearchSortTransfer->getSortParamLocalizedNames());
    }
}
