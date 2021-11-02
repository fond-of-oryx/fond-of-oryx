<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchPaginationTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchResultItemTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchSortTransfer;

class RestCompanyBusinessUnitAddressSearchAttributesMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchResultItemMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyBusinessUnitAddressSearchResultItemMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchSortMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyBusinessUnitAddressSearchSortMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchPaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyBusinessUnitAddressSearchPaginationMapperMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitAddressListTransferMock;

    /**
     * @var array
     */
    protected $restCompanyBusinessUnitAddressSearchResultItemTransferMocks;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyBusinessUnitAddressSearchSortTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchPaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyBusinessUnitAddressSearchPaginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchAttributesMapper
     */
    protected $restCompanyBusinessUnitAddressSearchAttributesMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restCompanyBusinessUnitAddressSearchResultItemMapperMock = $this->getMockBuilder(RestCompanyBusinessUnitAddressSearchResultItemMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchSortMapperMock = $this->getMockBuilder(RestCompanyBusinessUnitAddressSearchSortMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchPaginationMapperMock = $this->getMockBuilder(RestCompanyBusinessUnitAddressSearchPaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitAddressListTransferMock = $this->getMockBuilder(CompanyBusinessUnitAddressListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchResultItemTransferMocks = [
            $this->getMockBuilder(RestCompanyBusinessUnitAddressSearchResultItemTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->restCompanyBusinessUnitAddressSearchSortTransferMock = $this->getMockBuilder(RestCompanyBusinessUnitAddressSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchPaginationTransferMock = $this->getMockBuilder(RestCompanyBusinessUnitAddressSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchAttributesMapper = new RestCompanyBusinessUnitAddressSearchAttributesMapper(
            $this->restCompanyBusinessUnitAddressSearchResultItemMapperMock,
            $this->restCompanyBusinessUnitAddressSearchSortMapperMock,
            $this->restCompanyBusinessUnitAddressSearchPaginationMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testFromCompanyBusinessUnitAddressList(): void
    {
        $companies = new ArrayObject($this->restCompanyBusinessUnitAddressSearchResultItemTransferMocks);

        $this->restCompanyBusinessUnitAddressSearchResultItemMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyBusinessUnitAddressList')
            ->with($this->companyBusinessUnitAddressListTransferMock)
            ->willReturn($companies);

        $this->restCompanyBusinessUnitAddressSearchSortMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyBusinessUnitAddressList')
            ->with($this->companyBusinessUnitAddressListTransferMock)
            ->willReturn($this->restCompanyBusinessUnitAddressSearchSortTransferMock);

        $this->restCompanyBusinessUnitAddressSearchPaginationMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyBusinessUnitAddressList')
            ->with($this->companyBusinessUnitAddressListTransferMock)
            ->willReturn($this->restCompanyBusinessUnitAddressSearchPaginationTransferMock);

        $restCompanyBusinessUnitAddressSearchAttributesTransfer = $this->restCompanyBusinessUnitAddressSearchAttributesMapper->fromCompanyBusinessUnitAddressList(
            $this->companyBusinessUnitAddressListTransferMock,
        );

        static::assertEquals(
            $companies,
            $restCompanyBusinessUnitAddressSearchAttributesTransfer->getCompanyBusinessUnitAddresses(),
        );

        static::assertEquals(
            $this->restCompanyBusinessUnitAddressSearchSortTransferMock,
            $restCompanyBusinessUnitAddressSearchAttributesTransfer->getSort(),
        );

        static::assertEquals(
            $this->restCompanyBusinessUnitAddressSearchPaginationTransferMock,
            $restCompanyBusinessUnitAddressSearchAttributesTransfer->getPagination(),
        );
    }
}
