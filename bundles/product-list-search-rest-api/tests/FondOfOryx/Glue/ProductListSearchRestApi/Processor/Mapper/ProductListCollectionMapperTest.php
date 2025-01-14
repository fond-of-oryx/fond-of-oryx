<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\PaginationTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class ProductListCollectionMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\PaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $filterFieldsMapperMock;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\PaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $paginationMapperMock;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Filter\RequestParameterFilterInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $requestParameterFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\PaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $paginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper\ProductListCollectionMapper
     */
    protected $productListCollectionMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->filterFieldsMapperMock = $this->getMockBuilder(FilterFieldsMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paginationMapperMock = $this->getMockBuilder(PaginationMapperInterface::class)
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

        $this->productListCollectionMapper = new ProductListCollectionMapper(
            $this->paginationMapperMock,
            $this->requestParameterFilterMock,
            $this->filterFieldsMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $self = $this;

        $query = 'foo';
        $sort = 'foo_asc';

        $this->filterFieldsMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn(new ArrayObject());

        $this->paginationMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->paginationTransferMock);

        $callCount = $this->atLeastOnce();
        $this->requestParameterFilterMock->expects($callCount)
            ->method('getRequestParameter')
            ->willReturnCallback(static function (RestRequestInterface $restRequest, string $parameterName) use ($self, $callCount, $query, $sort) {
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
                        $self->assertSame('sort', $parameterName);

                        return $sort;
                }

                throw new Exception('Unexpected call count');
            });

        $productListCollectionTransfer = $this->productListCollectionMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals(
            $sort,
            $productListCollectionTransfer->getSort(),
        );

        static::assertTrue(
            $productListCollectionTransfer->getShowAll(),
        );

        static::assertEquals(
            $query,
            $productListCollectionTransfer->getQuery(),
        );

        static::assertEquals(
            $this->paginationTransferMock,
            $productListCollectionTransfer->getPagination(),
        );
    }
}
