<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerIdFilterInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\PaginationTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyRoleListMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\PaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $paginationMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\RequestParameterFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $requestParameterFilterMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $customerReferenceFilterMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Filter\CustomerIdFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
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
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\CompanyRoleListMapper
     */
    protected $companyRoleListMapper;

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

        $this->companyRoleListMapper = new CompanyRoleListMapper(
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
        $self = $this;

        $customerReference = 'CUSTOMER_REFERENCE';
        $query = 'query';
        $sort = 'sort';
        $comanyUuid = 'company-uuid';

        $this->paginationMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->paginationTransferMock);

        $callCount = $this->atLeastOnce();
        $this->requestParameterFilterMock->expects($callCount)
            ->method('getRequestParameter')
            ->willReturnCallback(static function (RestRequestInterface $restRequest, string $parameterName) use ($self, $callCount, $query, $sort, $comanyUuid) {
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
                        $self->assertSame('q', $parameterName);

                        return $query;
                    case 2:
                        $self->assertSame($self->restRequestMock, $restRequest);
                        $self->assertSame('show-all', $parameterName);

                        return 'true';
                    case 3:
                        $self->assertSame($self->restRequestMock, $restRequest);
                        $self->assertSame('only-one-per-name', $parameterName);

                        return 'true';
                    case 4:
                        $self->assertSame($self->restRequestMock, $restRequest);
                        $self->assertSame('company-id', $parameterName);

                        return $comanyUuid;
                    case 5:
                        $self->assertSame($self->restRequestMock, $restRequest);
                        $self->assertSame('sort', $parameterName);

                        return $sort;
                }

                throw new Exception('Unexpected call count');
            });

        $this->customerReferenceFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($customerReference);

        $companyRoleListTransfer = $this->companyRoleListMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals(
            $customerReference,
            $companyRoleListTransfer->getCustomerReference(),
        );

        static::assertEquals(
            $sort,
            $companyRoleListTransfer->getSort(),
        );

        static::assertEquals(
            $comanyUuid,
            $companyRoleListTransfer->getCompanyUuid(),
        );

        static::assertTrue(
            $companyRoleListTransfer->getShowAll(),
        );

        static::assertTrue(
            $companyRoleListTransfer->getOnlyOnePerName(),
        );

        static::assertEquals(
            $query,
            $companyRoleListTransfer->getQuery(),
        );

        static::assertEquals(
            $this->paginationTransferMock,
            $companyRoleListTransfer->getPagination(),
        );
    }
}
