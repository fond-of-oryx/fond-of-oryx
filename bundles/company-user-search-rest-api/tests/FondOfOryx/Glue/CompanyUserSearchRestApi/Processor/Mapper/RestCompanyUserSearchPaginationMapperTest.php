<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\PaginationTransfer;

class RestCompanyUserSearchPaginationMapperTest extends Unit
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
     * @var \Generated\Shared\Transfer\PaginationTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $paginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchPaginationMapper
     */
    protected $restCompanyUserSearchPaginationMapper;

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

        $this->paginationTransferMock = $this->getMockBuilder(PaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchPaginationMapper = new RestCompanyUserSearchPaginationMapper($this->configMock);
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

        $this->companyUserListTransferMock->expects(static::atLeastOnce())
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

        $this->restCompanyUserSearchPaginationMapper->fromCompanyUserList(
            $this->companyUserListTransferMock
        );
    }

    /**
     * @return void
     */
    public function testFromCompanyListWithNullablePagination(): void
    {
        $this->companyUserListTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn(null);

        $this->configMock->expects(static::never())
            ->method('getItemsPerPage');

        $this->configMock->expects(static::never())
            ->method('getValidItemsPerPageOptions');

        $this->restCompanyUserSearchPaginationMapper->fromCompanyUserList(
            $this->companyUserListTransferMock
        );
    }
}
