<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchPaginationTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchResultItemTransfer;
use Generated\Shared\Transfer\RestCompanyRoleSearchSortTransfer;

class RestCompanyRoleSearchAttributesMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchResultItemMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyRoleSearchResultItemMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchSortMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyRoleSearchSortMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchPaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyRoleSearchPaginationMapperMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleListTransferMock;

    /**
     * @var array
     */
    protected $restCompanyRoleSearchResultItemTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyRoleSearchSortTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyRoleSearchPaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyRoleSearchPaginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\RestCompanyRoleSearchAttributesMapper
     */
    protected $restCompanyRoleSearchAttributesMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restCompanyRoleSearchResultItemMapperMock = $this->getMockBuilder(RestCompanyRoleSearchResultItemMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleSearchSortMapperMock = $this->getMockBuilder(RestCompanyRoleSearchSortMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleSearchPaginationMapperMock = $this->getMockBuilder(RestCompanyRoleSearchPaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleListTransferMock = $this->getMockBuilder(CompanyRoleListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleSearchResultItemTransferMocks = [
            $this->getMockBuilder(RestCompanyRoleSearchResultItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restCompanyRoleSearchSortTransferMock = $this->getMockBuilder(RestCompanyRoleSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleSearchPaginationTransferMock = $this->getMockBuilder(RestCompanyRoleSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyRoleSearchAttributesMapper = new RestCompanyRoleSearchAttributesMapper(
            $this->restCompanyRoleSearchResultItemMapperMock,
            $this->restCompanyRoleSearchSortMapperMock,
            $this->restCompanyRoleSearchPaginationMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testFromCompanyList(): void
    {
        $roles = new ArrayObject($this->restCompanyRoleSearchResultItemTransferMocks);

        $this->restCompanyRoleSearchResultItemMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyRoleList')
            ->with($this->companyRoleListTransferMock)
            ->willReturn($roles);

        $this->restCompanyRoleSearchSortMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyRoleList')
            ->with($this->companyRoleListTransferMock)
            ->willReturn($this->restCompanyRoleSearchSortTransferMock);

        $this->restCompanyRoleSearchPaginationMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyRoleList')
            ->with($this->companyRoleListTransferMock)
            ->willReturn($this->restCompanyRoleSearchPaginationTransferMock);

        $restCompanyRoleSearchAttributesTransfer = $this->restCompanyRoleSearchAttributesMapper->fromCompanyRoleList(
            $this->companyRoleListTransferMock,
        );

        static::assertEquals(
            $roles,
            $restCompanyRoleSearchAttributesTransfer->getCompanyRole(),
        );

        static::assertEquals(
            $this->restCompanyRoleSearchSortTransferMock,
            $restCompanyRoleSearchAttributesTransfer->getSort(),
        );

        static::assertEquals(
            $this->restCompanyRoleSearchPaginationTransferMock,
            $restCompanyRoleSearchAttributesTransfer->getPagination(),
        );
    }
}
