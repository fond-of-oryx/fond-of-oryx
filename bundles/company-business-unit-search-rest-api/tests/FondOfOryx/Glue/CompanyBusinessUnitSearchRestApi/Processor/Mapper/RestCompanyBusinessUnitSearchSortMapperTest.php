<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig;
use FondOfOryx\Shared\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConstants;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Generated\Shared\Transfer\FilterFieldTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RestCompanyBusinessUnitSearchSortMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected FilterFieldTransfer|MockObject $filterMock;

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

        $this->filterMock = $this->getMockBuilder(FilterFieldTransfer::class)
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
        $filter = new ArrayObject();
        $filter->append($this->filterMock);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamNames')
            ->willReturn($sortParamNames);

        $this->filterMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyBusinessUnitSearchRestApiConstants::FILTER_FIELD_TYPE_SORT);

        $this->filterMock->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($sortParamNames[0]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($sortParamLocalizedNames);

        $this->companyBusinessUnitListTransferMock->expects(static::atLeastOnce())
            ->method('getFilterFields')
            ->willReturn($filter);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortFields')
            ->willReturn($sortFields);

        $restCompanyBusinessUnitSearchSortTransfer = $this->restCompanyBusinessUnitSearchSortMapper->fromCompanyBusinessUnitList(
            $this->companyBusinessUnitListTransferMock,
        );

        static::assertEquals('asc', $restCompanyBusinessUnitSearchSortTransfer->getCurrentSortOrder());
        static::assertEquals($sortParamNames[0], $restCompanyBusinessUnitSearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restCompanyBusinessUnitSearchSortTransfer->getSortParamNames());
        static::assertEquals($sortParamLocalizedNames, $restCompanyBusinessUnitSearchSortTransfer->getSortParamLocalizedNames());
    }
}
