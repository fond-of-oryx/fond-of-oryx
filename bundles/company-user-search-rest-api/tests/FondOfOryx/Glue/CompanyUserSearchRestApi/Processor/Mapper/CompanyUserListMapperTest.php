<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Exception;
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\PaginationMapperInterface
     */
    protected MockObject|PaginationMapperInterface $paginationMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface
     */
    protected MockObject|FilterFieldsMapperInterface $filterFieldsMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected MockObject|RequestParameterFilterInterface $requestParameterFilterMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected CustomerReferenceFilterInterface|MockObject $customerReferenceFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CustomerIdFilterInterface
     */
    protected MockObject|CustomerIdFilterInterface $customerIdFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\CompanyRoleNameFilterInterface
     */
    protected MockObject|CompanyRoleNameFilterInterface $companyRoleNameFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Filter\EmailFilterInterface
     */
    protected MockObject|EmailFilterInterface $emailFilterMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaginationTransfer
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
        $self = $this;

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

        $callCount = $this->atLeastOnce();
        $this->requestParameterFilterMock->expects($callCount)
            ->method('getRequestParameter')
            ->willReturnCallback(static function (RestRequestInterface $restRequest, string $parameterName) use ($self, $callCount, $companyUuid, $companyUserReference) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame($self->restRequestMock, $restRequest);
                        $self->assertSame('show-all', $parameterName);

                        return 'true';
                    case 2:
                        $self->assertSame($self->restRequestMock, $restRequest);
                        $self->assertSame('only-one-per-customer', $parameterName);

                        return 'true';
                    case 3:
                        $self->assertSame($self->restRequestMock, $restRequest);
                        $self->assertSame('company-id', $parameterName);

                        return $companyUuid;
                    case 4:
                        $self->assertSame($self->restRequestMock, $restRequest);
                        $self->assertSame('company-user-reference', $parameterName);

                        return $companyUserReference;
                }

                throw new Exception('Unexpected call count');
            });

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
