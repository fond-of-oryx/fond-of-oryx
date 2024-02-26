<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig;
use FondOfOryx\Shared\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConstants;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\FilterFieldTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RestCompanyBusinessUnitAddressSearchSortMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitAddressListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected FilterFieldTransfer|MockObject $filterFieldTransferMock;

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

        $this->filterFieldTransferMock = $this->getMockBuilder(FilterFieldTransfer::class)
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
        $collection = new ArrayObject();
        $collection->append($this->filterFieldTransferMock);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamNames')
            ->willReturn($sortParamNames);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortParamLocalizedNames')
            ->willReturn($sortParamLocalizedNames);

        $this->companyBusinessUnitAddressListTransferMock->expects(static::atLeastOnce())
            ->method('getFilterFields')
            ->willReturn($collection);

        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getType')
            ->willReturn(CompanyBusinessUnitAddressSearchRestApiConstants::FILTER_FIELD_TYPE_SORT);

        $this->filterFieldTransferMock->expects(static::atLeastOnce())
            ->method('getValue')
            ->willReturn($sortParamNames[0]);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSortFields')
            ->willReturn($sortFields);

        $restCompanyBusinessUnitAddressSearchSortTransfer = $this->restCompanyBusinessUnitAddressSearchSortMapper->fromCompanyBusinessUnitAddressList(
            $this->companyBusinessUnitAddressListTransferMock,
        );

        static::assertEquals('asc', $restCompanyBusinessUnitAddressSearchSortTransfer->getCurrentSortOrder());
        static::assertEquals($sortParamNames[0], $restCompanyBusinessUnitAddressSearchSortTransfer->getCurrentSortParam());
        static::assertEquals($sortParamNames, $restCompanyBusinessUnitAddressSearchSortTransfer->getSortParamNames());
        static::assertEquals($sortParamLocalizedNames, $restCompanyBusinessUnitAddressSearchSortTransfer->getSortParamLocalizedNames());
    }
}
