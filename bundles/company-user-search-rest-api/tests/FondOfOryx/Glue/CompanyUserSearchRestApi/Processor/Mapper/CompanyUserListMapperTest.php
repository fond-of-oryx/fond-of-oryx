<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\PaginationTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUserListMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\PaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $paginationMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $requestParameterFilterMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $customerReferenceFilterMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerIdFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $customerIdFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\PaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $paginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\CompanyUserListMapper
     */
    protected $companyUserListMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paginationMapperMock = $this->getMockBuilder(PaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameterFilterMock = $this->getMockBuilder(RequestParameterFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerReferenceFilterMock = $this->getMockBuilder(CustomerReferenceFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerIdFilterMock = $this->getMockBuilder(CustomerIdFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paginationTransferMock = $this->getMockBuilder(PaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserListMapper = new CompanyUserListMapper(
            $this->paginationMapperMock,
            $this->requestParameterFilterMock,
            $this->customerReferenceFilterMock,
            $this->customerIdFilterMock,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $customerReference = 'FOO-C--1';
        $query = 'foo';
        $sort = 'foo_asc';
        $comanyUuid = 'foo company uuid';

        $this->paginationMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->paginationTransferMock);

        $this->requestParameterFilterMock->expects(static::atLeastOnce())
            ->method('getRequestParameter')
            ->withConsecutive([$this->restRequestMock, 'q'], [$this->restRequestMock, 'show-all'], [$this->restRequestMock, 'company-id'], [$this->restRequestMock, 'sort'])
            ->willReturnOnConsecutiveCalls($query, 'true', $comanyUuid, $sort);

        $this->customerReferenceFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($customerReference);

        $companyUserListTransfer = $this->companyUserListMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals(
            $customerReference,
            $companyUserListTransfer->getCustomerReference(),
        );

        static::assertEquals(
            $sort,
            $companyUserListTransfer->getSort(),
        );

        static::assertEquals(
            $comanyUuid,
            $companyUserListTransfer->getCompanyUuid(),
        );

        static::assertTrue(
            $companyUserListTransfer->getShowAll(),
        );

        static::assertEquals(
            $query,
            $companyUserListTransfer->getQuery(),
        );

        static::assertEquals(
            $this->paginationTransferMock,
            $companyUserListTransfer->getPagination(),
        );
    }
}
