<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyUserListTransfer;

class RestCompanyUserSearchSortMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyUserListTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchSortMapper
     */
    protected $restCompanyUserSearchSortMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(CompanyUserSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserListTransferMock = $this->getMockBuilder(CompanyUserListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchSortMapper = new RestCompanyUserSearchSortMapper($this->configMock);
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

        $this->companyUserListTransferMock->expects(static::atLeastOnce())
            ->method('getSort')
            ->willReturn($sortParamNames[0]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortFields')
            ->willReturn($sortFields);

        $restCompanyUserSearchSortTransfer = $this->restCompanyUserSearchSortMapper->fromCompanyUserList(
            $this->companyUserListTransferMock
        );

        static::assertEquals('asc', $restCompanyUserSearchSortTransfer->getCurrentSortOrder());
        static::assertEquals($sortParamNames[0], $restCompanyUserSearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restCompanyUserSearchSortTransfer->getSortParamNames());
        static::assertEquals($sortParamLocalizedNames, $restCompanyUserSearchSortTransfer->getSortParamLocalizedNames());
    }
}
