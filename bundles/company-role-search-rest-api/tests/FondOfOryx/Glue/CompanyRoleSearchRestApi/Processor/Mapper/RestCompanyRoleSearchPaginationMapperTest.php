<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConfig;
use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Generated\Shared\Transfer\PaginationTransfer;

class RestCompanyRoleSearchPaginationMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\PaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $paginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchPaginationMapper
     */
    protected $restCompanyRoleSearchPaginationMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(CompanyRoleSearchRestApiConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleListTransferMock = $this->getMockBuilder(CompanyRoleListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paginationTransferMock = $this->getMockBuilder(PaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleSearchPaginationMapper = new RestCompanyRoleSearchPaginationMapper($this->configMock);
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

        $this->companyRoleListTransferMock->expects(static::atLeastOnce())
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

        $this->restCompanyRoleSearchPaginationMapper->fromCompanyRoleList(
            $this->companyRoleListTransferMock,
        );
    }

    /**
     * @return void
     */
    public function testFromCompanyListWithNullablePagination(): void
    {
        $this->companyRoleListTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn(null);

        $this->configMock->expects(static::never())
            ->method('getItemsPerPage');

        $this->configMock->expects(static::never())
            ->method('getValidItemsPerPageOptions');

        $this->restCompanyRoleSearchPaginationMapper->fromCompanyRoleList(
            $this->companyRoleListTransferMock,
        );
    }
}
