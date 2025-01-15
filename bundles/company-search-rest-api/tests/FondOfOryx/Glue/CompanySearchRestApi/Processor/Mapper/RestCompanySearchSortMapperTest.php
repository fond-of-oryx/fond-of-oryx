<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\FilterFieldTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RestCompanySearchSortMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanySearchRestApiConfig|MockObject $configMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CompanyListTransfer|MockObject $companyListTransferMock;

    /**
     * @var array<\Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected array $filterFieldTransferMocks;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchSortMapper
     */
    protected RestCompanySearchSortMapper $restCompanySearchSortMapper;

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

        $this->filterFieldTransferMocks = [
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            $this->getMockBuilder(FilterFieldTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

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

        $restCompanySearchSortTransfer = $this->restCompanySearchSortMapper->fromCompanyList(
            $this->companyListTransferMock,
        );

        static::assertEquals('asc', $restCompanySearchSortTransfer->getCurrentSortOrder());
        static::assertEquals($sortParamNames[0], $restCompanySearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restCompanySearchSortTransfer->getSortParamNames());
        static::assertEquals($sortParamLocalizedNames, $restCompanySearchSortTransfer->getSortParamLocalizedNames());
    }
}
