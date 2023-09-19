<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CompanyRoleNameFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\EmailFilterInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\PaginationTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUserListMapperTest extends Unit
{
    /**
     * @var (\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\PaginationMapperInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|PaginationMapperInterface $paginationMapperMock;

    /**
     * @var (\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|FilterFieldsMapperInterface $filterFieldsMapperMock;

    /**
     * @var (\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RequestParameterFilterInterface $requestParameterFilterMock;

    /**
     * @var (\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerReferenceFilterInterface|MockObject $customerReferenceFilterMock;

    /**
     * @var (\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerIdFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerIdFilterInterface $customerIdFilterMock;

    /**
     * @var (\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CompanyRoleNameFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CompanyRoleNameFilterInterface $companyRoleNameFilterMock;

    /**
     * @var (\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\EmailFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|EmailFilterInterface $emailFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var (\Generated\Shared\Transfer\PaginationTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|PaginationTransfer $paginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\CompanyUserListMapper
     */
    protected CompanyUserListMapper $companyUserListMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paginationMapperMock = $this->getMockBuilder(PaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldsMapperMock = $this->getMockBuilder(FilterFieldsMapperInterface::class)
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

        $this->companyRoleNameFilterMock = $this->getMockBuilder(CompanyRoleNameFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->emailFilterMock = $this->getMockBuilder(EmailFilterInterface::class)
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
            $this->filterFieldsMapperMock,
            $this->requestParameterFilterMock,
            $this->customerReferenceFilterMock,
            $this->customerIdFilterMock,
            $this->companyRoleNameFilterMock,
            $this->emailFilterMock,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $customerReference = 'FOO-C--1';
        $companyUuid = 'foo company uuid';
        $companyUserReference = 'FOO-CU--1';
        $companyRoleNames = ['foo', 'bar'];
        $emails = ['foo@bar.com', 'bar@foo.com'];

        $this->paginationMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->paginationTransferMock);

        $this->filterFieldsMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn(new ArrayObject());

        $this->requestParameterFilterMock->expects(static::atLeastOnce())
            ->method('getRequestParameter')
            ->withConsecutive(
                [$this->restRequestMock, 'show-all'],
                [$this->restRequestMock, 'only-one-per-customer'],
                [$this->restRequestMock, 'company-id'],
                [$this->restRequestMock, 'company-user-reference'],
            )->willReturnOnConsecutiveCalls(
                'true',
                'true',
                $companyUuid,
                $companyUserReference,
            );

        $this->customerReferenceFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($customerReference);

        $this->companyRoleNameFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($companyRoleNames);

        $this->emailFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($emails);

        $companyUserListTransfer = $this->companyUserListMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals(
            $customerReference,
            $companyUserListTransfer->getCustomerReference(),
        );

        static::assertEquals(
            $companyUuid,
            $companyUserListTransfer->getCompanyUuid(),
        );

        static::assertTrue(
            $companyUserListTransfer->getShowAll(),
        );

        static::assertTrue(
            $companyUserListTransfer->getOnlyOnePerCustomer(),
        );

        static::assertEquals(
            $this->paginationTransferMock,
            $companyUserListTransfer->getPagination(),
        );

        static::assertEquals(
            $companyRoleNames,
            $companyUserListTransfer->getCompanyRoleNames(),
        );

        static::assertEquals(
            $emails,
            $companyUserListTransfer->getEmails(),
        );
    }
}
