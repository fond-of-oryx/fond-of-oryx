<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\PaginationTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyBusinessUnitAddressListMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\PaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $paginationMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\RequestParameterFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $requestParameterFilterMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $customerReferenceFilterMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Filter\CustomerIdFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
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
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\CompanyBusinessUnitAddressListMapper
     */
    protected $companyBusinessUnitAddressListMapper;

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

        $this->companyBusinessUnitAddressListMapper = new CompanyBusinessUnitAddressListMapper(
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
        $comanyBUUuid = 'foo company bu uuid';

        $this->paginationMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->paginationTransferMock);

        $this->requestParameterFilterMock->expects(static::atLeastOnce())
            ->method('getRequestParameter')
            ->withConsecutive([$this->restRequestMock, 'company-id'], [$this->restRequestMock, 'company-business-unit-id'], [$this->restRequestMock, 'default-billing'], [$this->restRequestMock, 'default-shipping'], [$this->restRequestMock, 'sort'])
            ->willReturnOnConsecutiveCalls($comanyUuid, $comanyBUUuid, 'true', 'true', $sort);

        $this->customerReferenceFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($customerReference);

        $companyBusinessUnitAddressListTransfer = $this->companyBusinessUnitAddressListMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals(
            $customerReference,
            $companyBusinessUnitAddressListTransfer->getCustomerReference(),
        );

        static::assertEquals(
            $sort,
            $companyBusinessUnitAddressListTransfer->getSort(),
        );

        static::assertEquals(
            $comanyUuid,
            $companyBusinessUnitAddressListTransfer->getCompanyUuid(),
        );

        static::assertEquals(
            $comanyBUUuid,
            $companyBusinessUnitAddressListTransfer->getCompanyBusinessUnitUuid(),
        );

        static::assertEquals(
            true,
            $companyBusinessUnitAddressListTransfer->getDefaultBilling(),
        );

        static::assertEquals(
            true,
            $companyBusinessUnitAddressListTransfer->getDefaultShipping(),
        );

        static::assertEquals(
            $this->paginationTransferMock,
            $companyBusinessUnitAddressListTransfer->getPagination(),
        );
    }
}
