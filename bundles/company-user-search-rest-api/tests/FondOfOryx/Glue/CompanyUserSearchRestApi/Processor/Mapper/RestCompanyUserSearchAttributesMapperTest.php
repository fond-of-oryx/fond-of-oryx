<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchPaginationTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchResultItemTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchSortTransfer;

class RestCompanyUserSearchAttributesMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchResultItemMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUserSearchResultItemMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchSortMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUserSearchSortMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchPaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUserSearchPaginationMapperMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserListTransferMock;

    /**
     * @var array
     */
    protected $restCompanyUserSearchResultItemTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUserSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUserSearchSortTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUserSearchPaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUserSearchPaginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchAttributesMapper
     */
    protected $restCompanyUserSearchAttributesMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restCompanyUserSearchResultItemMapperMock = $this->getMockBuilder(RestCompanyUserSearchResultItemMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchSortMapperMock = $this->getMockBuilder(RestCompanyUserSearchSortMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchPaginationMapperMock = $this->getMockBuilder(RestCompanyUserSearchPaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserListTransferMock = $this->getMockBuilder(CompanyUserListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchResultItemTransferMocks = [
            $this->getMockBuilder(RestCompanyUserSearchResultItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restCompanyUserSearchSortTransferMock = $this->getMockBuilder(RestCompanyUserSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchPaginationTransferMock = $this->getMockBuilder(RestCompanyUserSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchAttributesMapper = new RestCompanyUserSearchAttributesMapper(
            $this->restCompanyUserSearchResultItemMapperMock,
            $this->restCompanyUserSearchSortMapperMock,
            $this->restCompanyUserSearchPaginationMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testFromCompanyList(): void
    {
        $companies = new ArrayObject($this->restCompanyUserSearchResultItemTransferMocks);

        $this->restCompanyUserSearchResultItemMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyUserList')
            ->with($this->companyUserListTransferMock)
            ->willReturn($companies);

        $this->restCompanyUserSearchSortMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyUserList')
            ->with($this->companyUserListTransferMock)
            ->willReturn($this->restCompanyUserSearchSortTransferMock);

        $this->restCompanyUserSearchPaginationMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyUserList')
            ->with($this->companyUserListTransferMock)
            ->willReturn($this->restCompanyUserSearchPaginationTransferMock);

        $restCompanyUserSearchAttributesTransfer = $this->restCompanyUserSearchAttributesMapper->fromCompanyUserList(
            $this->companyUserListTransferMock,
        );

        static::assertEquals(
            $companies,
            $restCompanyUserSearchAttributesTransfer->getCompanyUser(),
        );

        static::assertEquals(
            $this->restCompanyUserSearchSortTransferMock,
            $restCompanyUserSearchAttributesTransfer->getSort(),
        );

        static::assertEquals(
            $this->restCompanyUserSearchPaginationTransferMock,
            $restCompanyUserSearchAttributesTransfer->getPagination(),
        );
    }
}
