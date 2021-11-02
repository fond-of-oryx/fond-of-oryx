<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\RestCompanySearchPaginationTransfer;
use Generated\Shared\Transfer\RestCompanySearchResultItemTransfer;
use Generated\Shared\Transfer\RestCompanySearchSortTransfer;

class RestCompanySearchAttributesMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchResultItemMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanySearchResultItemMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchSortMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanySearchSortMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchPaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanySearchPaginationMapperMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyListTransferMock;

    /**
     * @var array
     */
    protected $restCompanySearchResultItemTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\RestCompanySearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanySearchSortTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanySearchPaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanySearchPaginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchAttributesMapper
     */
    protected $restCompanySearchAttributesMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restCompanySearchResultItemMapperMock = $this->getMockBuilder(RestCompanySearchResultItemMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanySearchSortMapperMock = $this->getMockBuilder(RestCompanySearchSortMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanySearchPaginationMapperMock = $this->getMockBuilder(RestCompanySearchPaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyListTransferMock = $this->getMockBuilder(CompanyListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanySearchResultItemTransferMocks = [
            $this->getMockBuilder(RestCompanySearchResultItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restCompanySearchSortTransferMock = $this->getMockBuilder(RestCompanySearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanySearchPaginationTransferMock = $this->getMockBuilder(RestCompanySearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanySearchAttributesMapper = new RestCompanySearchAttributesMapper(
            $this->restCompanySearchResultItemMapperMock,
            $this->restCompanySearchSortMapperMock,
            $this->restCompanySearchPaginationMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testFromCompanyList(): void
    {
        $companies = new ArrayObject($this->restCompanySearchResultItemTransferMocks);

        $this->restCompanySearchResultItemMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyList')
            ->with($this->companyListTransferMock)
            ->willReturn($companies);

        $this->restCompanySearchSortMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyList')
            ->with($this->companyListTransferMock)
            ->willReturn($this->restCompanySearchSortTransferMock);

        $this->restCompanySearchPaginationMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyList')
            ->with($this->companyListTransferMock)
            ->willReturn($this->restCompanySearchPaginationTransferMock);

        $restCompanySearchAttributesTransfer = $this->restCompanySearchAttributesMapper->fromCompanyList(
            $this->companyListTransferMock,
        );

        static::assertEquals(
            $companies,
            $restCompanySearchAttributesTransfer->getCompanies(),
        );

        static::assertEquals(
            $this->restCompanySearchSortTransferMock,
            $restCompanySearchAttributesTransfer->getSort(),
        );

        static::assertEquals(
            $this->restCompanySearchPaginationTransferMock,
            $restCompanySearchAttributesTransfer->getPagination(),
        );
    }
}
