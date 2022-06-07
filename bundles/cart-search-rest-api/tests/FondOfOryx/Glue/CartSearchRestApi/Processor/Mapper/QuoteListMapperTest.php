<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\PaginationTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class QuoteListMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\PaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $paginationMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\PaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $paginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\QuoteListMapper
     */
    protected $quoteListMapper;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\FilterFieldsMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterFieldsMapperMock;

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

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paginationTransferMock = $this->getMockBuilder(PaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteListMapper = new QuoteListMapper(
            $this->filterFieldsMapperMock,
            $this->paginationMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $filterFieldTransfers = new ArrayObject();

        $this->paginationMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->paginationTransferMock);

        $this->filterFieldsMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($filterFieldTransfers);

        $quoteListTransfer = $this->quoteListMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals(
            $this->paginationTransferMock,
            $quoteListTransfer->getPagination(),
        );

        static::assertEquals(
            $filterFieldTransfers,
            $quoteListTransfer->getFilterFields(),
        );
    }
}
