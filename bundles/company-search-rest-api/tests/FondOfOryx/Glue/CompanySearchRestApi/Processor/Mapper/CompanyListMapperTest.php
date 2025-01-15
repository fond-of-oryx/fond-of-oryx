<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\PaginationTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyListMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\PaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected PaginationMapperInterface|MockObject $paginationMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\FilterFieldsMapperInterface
     */
    protected MockObject|FilterFieldsMapperInterface $filterFieldsMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface
     */
    protected MockObject|RequestParameterFilterInterface $requestParameterFilterMock;

    /**
     * @var \Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\PaginationTransfer
     */
    protected MockObject|PaginationTransfer $paginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\CompanyListMapper
     */
    protected CompanyListMapper $companyListMapper;

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

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paginationTransferMock = $this->getMockBuilder(PaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyListMapper = new CompanyListMapper(
            $this->paginationMapperMock,
            $this->filterFieldsMapperMock,
            $this->requestParameterFilterMock,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $self = $this;

        $companyUuid = 'e5046482-92ba-4c21-a239-db9ce1bc3c60';
        $query = 'foo';
        $sort = 'foo_asc';

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
            ->willReturnCallback(static function (RestRequestInterface $restRequest, string $parameterName) use ($self, $callCount, $companyUuid, $sort) {
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
                        $self->assertSame('sort', $parameterName);

                        return $sort;
                    case 2:
                        $self->assertSame($self->restRequestMock, $restRequest);
                        $self->assertSame('id', $parameterName);

                        return $companyUuid;
                }

                throw new Exception('Unexpected call count');
            });

        $companyListTransfer = $this->companyListMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals(
            $sort,
            $companyListTransfer->getSort(),
        );

        static::assertEquals(
            $this->paginationTransferMock,
            $companyListTransfer->getPagination(),
        );
    }
}
