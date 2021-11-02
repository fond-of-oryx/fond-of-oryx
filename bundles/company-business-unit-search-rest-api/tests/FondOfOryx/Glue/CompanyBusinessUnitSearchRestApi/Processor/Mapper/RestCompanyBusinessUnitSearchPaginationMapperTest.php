<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Generated\Shared\Transfer\PaginationTransfer;

class RestCompanyBusinessUnitSearchPaginationMapperTest extends Unit
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
     * @var \Generated\Shared\Transfer\PaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $paginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitSearchPaginationMapper
     */
    protected $restCompanyBusinessUnitSearchPaginationMapper;

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

        $this->paginationTransferMock = $this->getMockBuilder(PaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitSearchPaginationMapper = new RestCompanyBusinessUnitSearchPaginationMapper($this->configMock);
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

        $this->companyBusinessUnitListTransferMock->expects(static::atLeastOnce())
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

        $this->restCompanyBusinessUnitSearchPaginationMapper->fromCompanyBusinessUnitList(
            $this->companyBusinessUnitListTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testFromCompanyListWithNullablePagination(): void
    {
        $this->companyBusinessUnitListTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn(null);

        $this->configMock->expects(static::never())
            ->method('getItemsPerPage');

        $this->configMock->expects(static::never())
            ->method('getValidItemsPerPageOptions');

        $this->restCompanyBusinessUnitSearchPaginationMapper->fromCompanyBusinessUnitList(
            $this->companyBusinessUnitListTransferMock,
        );
    }
}
