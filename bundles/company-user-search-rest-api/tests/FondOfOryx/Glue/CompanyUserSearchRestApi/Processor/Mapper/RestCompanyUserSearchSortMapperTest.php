<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\FilterFieldTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RestCompanyUserSearchSortMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig
     */
    protected MockObject|CompanyUserSearchRestApiConfig $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyUserListTransfer
     */
    protected MockObject|CompanyUserListTransfer $companyUserListTransferMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchSortMapper
     */
    protected RestCompanyUserSearchSortMapper $restCompanyUserSearchSortMapper;

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

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

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
            ->method('getFilterFields')
            ->willReturn(new ArrayObject($this->filterFieldTransferMocks));

        $this->filterFieldTransferMocks[0]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('foo');

        $this->filterFieldTransferMocks[0]->expects(static::never())
            ->method('getValue');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn('orderBy');

        $this->filterFieldTransferMocks[1]->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn('name::asc');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortFields')
            ->willReturn($sortFields);

        $restCompanyUserSearchSortTransfer = $this->restCompanyUserSearchSortMapper->fromCompanyUserList(
            $this->companyUserListTransferMock,
        );

        static::assertEquals('asc', $restCompanyUserSearchSortTransfer->getCurrentSortOrder());
        static::assertEquals($sortParamNames[0], $restCompanyUserSearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restCompanyUserSearchSortTransfer->getSortParamNames());
        static::assertEquals($sortParamLocalizedNames, $restCompanyUserSearchSortTransfer->getSortParamLocalizedNames());
    }
}
