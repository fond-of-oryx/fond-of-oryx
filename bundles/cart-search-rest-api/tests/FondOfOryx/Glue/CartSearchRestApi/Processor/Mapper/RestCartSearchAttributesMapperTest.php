<?php

namespace FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteListTransfer;
use Generated\Shared\Transfer\RestCartsAttributesTransfer;
use Generated\Shared\Transfer\RestCartSearchPaginationTransfer;
use Generated\Shared\Transfer\RestCartSearchSortTransfer;

class RestCartSearchAttributesMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartsAttributesMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCartsAttributesMapperMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchSortMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCartSearchSortMapperMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchPaginationMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCartSearchPaginationMapperMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartsAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCartsAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartSearchSortTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCartSearchSortTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCartSearchPaginationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCartSearchPaginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CartSearchRestApi\Processor\Mapper\RestCartSearchAttributesMapper
     */
    protected $restCartSearchAttributesMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restCartsAttributesMapperMock = $this->getMockBuilder(RestCartsAttributesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartSearchSortMapperMock = $this->getMockBuilder(RestCartSearchSortMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartSearchPaginationMapperMock = $this->getMockBuilder(RestCartSearchPaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteListTransferMock = $this->getMockBuilder(QuoteListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartsAttributesTransferMock = $this->getMockBuilder(RestCartsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartSearchSortTransferMock = $this->getMockBuilder(RestCartSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartSearchPaginationTransferMock = $this->getMockBuilder(RestCartSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCartSearchAttributesMapper = new RestCartSearchAttributesMapper(
            $this->restCartsAttributesMapperMock,
            $this->restCartSearchSortMapperMock,
            $this->restCartSearchPaginationMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testFromQuoteList(): void
    {
        $restCartsAttributesTransfers = new ArrayObject([$this->restCartsAttributesTransferMock]);

        $this->restCartsAttributesMapperMock->expects(static::atLeastOnce())
            ->method('fromQuoteList')
            ->with($this->quoteListTransferMock)
            ->willReturn($restCartsAttributesTransfers);

        $this->restCartSearchSortMapperMock->expects(static::atLeastOnce())
            ->method('fromQuoteList')
            ->with($this->quoteListTransferMock)
            ->willReturn($this->restCartSearchSortTransferMock);

        $this->restCartSearchPaginationMapperMock->expects(static::atLeastOnce())
            ->method('fromQuoteList')
            ->with($this->quoteListTransferMock)
            ->willReturn($this->restCartSearchPaginationTransferMock);

        $restCartSearchAttributesTransfer = $this->restCartSearchAttributesMapper->fromQuoteList(
            $this->quoteListTransferMock,
        );

        static::assertEquals(
            $this->restCartSearchPaginationTransferMock,
            $restCartSearchAttributesTransfer->getPagination(),
        );

        static::assertEquals(
            $this->restCartSearchSortTransferMock,
            $restCartSearchAttributesTransfer->getSort(),
        );

        static::assertEquals(
            $restCartsAttributesTransfers,
            $restCartSearchAttributesTransfer->getCarts(),
        );
    }
}
