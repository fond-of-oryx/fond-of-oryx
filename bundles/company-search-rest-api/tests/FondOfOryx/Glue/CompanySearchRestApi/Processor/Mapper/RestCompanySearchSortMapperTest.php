<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig;
use Generated\Shared\Transfer\CompanyListTransfer;

class RestCompanySearchSortMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyListTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchSortMapper
     */
    protected $restCompanySearchSortMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(CompanySearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyListTransferMock = $this->getMockBuilder(CompanyListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanySearchSortMapper = new RestCompanySearchSortMapper($this->configMock);
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

        $this->companyListTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($sortParamNames[0]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortFields')
            ->willReturn($sortFields);

        $restCompanySearchSortTransfer = $this->restCompanySearchSortMapper->fromCompanyList(
            $this->companyListTransferMock,
        );

        static::assertEquals('asc', $restCompanySearchSortTransfer->getCurrentSortOrder());
        static::assertEquals($sortParamNames[0], $restCompanySearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restCompanySearchSortTransfer->getSortParamNames());
        static::assertEquals($sortParamLocalizedNames, $restCompanySearchSortTransfer->getSortParamLocalizedNames());
    }
}
