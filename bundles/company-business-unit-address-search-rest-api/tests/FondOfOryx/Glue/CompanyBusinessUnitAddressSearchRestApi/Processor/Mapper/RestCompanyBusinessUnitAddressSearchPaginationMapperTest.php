<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\PaginationTransfer;

class RestCompanyBusinessUnitAddressSearchPaginationMapperTest extends Unit
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
     * @var \Generated\Shared\Transfer\PaginationTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchPaginationMapper
     */
    protected $restCompanyBusinessUnitAddressSearchPaginationMapper;

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

        $this->paginationTransferMock = $this->getMockBuilder(PaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchPaginationMapper = new RestCompanyBusinessUnitAddressSearchPaginationMapper($this->configMock);
    }

    /**
     * @return void
     */
    public function testFromCompanyList(): void
    {
        $page = 1;
        $maxPerPage = 12;
        $nbResults = 23;
        $lastPage = 2;
        $itemsPerPage = 24;
        $validItemsPerPageOptions = [12, 24, 36];

        $this->companyBusinessUnitAddressListTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn($this->paginationTransferMock);

        $this->paginationTransferMock->expects(static::atLeastOnce())
            ->method('getPage')
            ->willReturn($page);

        $this->paginationTransferMock->expects(static::atLeastOnce())
            ->method('getLastPage')
            ->willReturn($lastPage);

        $this->paginationTransferMock->expects(static::atLeastOnce())
            ->method('getMaxPerPage')
            ->willReturn($maxPerPage);

        $this->paginationTransferMock->expects(static::atLeastOnce())
            ->method('getNbResults')
            ->willReturn($nbResults);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getItemsPerPage')
            ->willReturn($itemsPerPage);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getValidItemsPerPageOptions')
            ->willReturn($validItemsPerPageOptions);

        $this->restCompanyBusinessUnitAddressSearchPaginationMapper->fromCompanyBusinessUnitAddressList(
            $this->companyBusinessUnitAddressListTransferMock
        );
    }

    /**
     * @return void
     */
    public function testFromCompanyListWithNullablePagination(): void
    {
        $this->companyBusinessUnitAddressListTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn(null);

        $this->configMock->expects(static::never())
            ->method('getItemsPerPage');

        $this->configMock->expects(static::never())
            ->method('getValidItemsPerPageOptions');

        $this->restCompanyBusinessUnitAddressSearchPaginationMapper->fromCompanyBusinessUnitAddressList(
            $this->companyBusinessUnitAddressListTransferMock
        );
    }
}
