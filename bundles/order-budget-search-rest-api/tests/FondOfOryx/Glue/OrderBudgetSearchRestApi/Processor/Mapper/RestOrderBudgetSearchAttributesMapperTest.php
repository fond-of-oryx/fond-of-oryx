<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\RestOrderBudgetsAttributesTransfer;
use Generated\Shared\Transfer\RestOrderBudgetSearchPaginationTransfer;
use Generated\Shared\Transfer\RestOrderBudgetSearchSortTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RestOrderBudgetSearchAttributesMapperTest extends Unit
{
    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetsAttributesMapperInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestOrderBudgetsAttributesMapperInterface|MockObject $restOrderBudgetsAttributesMapperMock;

    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchSortMapperInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestOrderBudgetSearchSortMapperInterface $restOrderBudgetSearchSortMapperMock;

    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchPaginationMapperInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestOrderBudgetSearchPaginationMapperInterface|MockObject $restOrderBudgetSearchPaginationMapperMock;

    /**
     * @var (\Generated\Shared\Transfer\OrderBudgetListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetListTransfer|MockObject $orderBudgetListTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\RestOrderBudgetsAttributesTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestOrderBudgetsAttributesTransfer $restOrderBudgetsAttributesTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\RestOrderBudgetSearchSortTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestOrderBudgetSearchSortTransfer $restOrderBudgetSearchSortTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\RestOrderBudgetSearchPaginationTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestOrderBudgetSearchPaginationTransfer|MockObject $restOrderBudgetSearchPaginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchAttributesMapper
     */
    protected RestOrderBudgetSearchAttributesMapper $restOrderBudgetSearchAttributesMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restOrderBudgetsAttributesMapperMock = $this->getMockBuilder(RestOrderBudgetsAttributesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchSortMapperMock = $this->getMockBuilder(RestOrderBudgetSearchSortMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchPaginationMapperMock = $this->getMockBuilder(RestOrderBudgetSearchPaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetListTransferMock = $this->getMockBuilder(OrderBudgetListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetsAttributesTransferMock = $this->getMockBuilder(RestOrderBudgetsAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchSortTransferMock = $this->getMockBuilder(RestOrderBudgetSearchSortTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchPaginationTransferMock = $this->getMockBuilder(RestOrderBudgetSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchAttributesMapper = new RestOrderBudgetSearchAttributesMapper(
            $this->restOrderBudgetsAttributesMapperMock,
            $this->restOrderBudgetSearchSortMapperMock,
            $this->restOrderBudgetSearchPaginationMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testFromOrderBudgetList(): void
    {
        $restOrderBudgetsAttributesTransfers = new ArrayObject([$this->restOrderBudgetsAttributesTransferMock]);

        $this->restOrderBudgetsAttributesMapperMock->expects(static::atLeastOnce())
            ->method('fromOrderBudgetList')
            ->with($this->orderBudgetListTransferMock)
            ->willReturn($restOrderBudgetsAttributesTransfers);

        $this->restOrderBudgetSearchSortMapperMock->expects(static::atLeastOnce())
            ->method('fromOrderBudgetList')
            ->with($this->orderBudgetListTransferMock)
            ->willReturn($this->restOrderBudgetSearchSortTransferMock);

        $this->restOrderBudgetSearchPaginationMapperMock->expects(static::atLeastOnce())
            ->method('fromOrderBudgetList')
            ->with($this->orderBudgetListTransferMock)
            ->willReturn($this->restOrderBudgetSearchPaginationTransferMock);

        $restOrderBudgetSearchAttributesTransfer = $this->restOrderBudgetSearchAttributesMapper->fromOrderBudgetList(
            $this->orderBudgetListTransferMock,
        );

        static::assertEquals(
            $this->restOrderBudgetSearchPaginationTransferMock,
            $restOrderBudgetSearchAttributesTransfer->getPagination(),
        );

        static::assertEquals(
            $this->restOrderBudgetSearchSortTransferMock,
            $restOrderBudgetSearchAttributesTransfer->getSort(),
        );

        static::assertEquals(
            $restOrderBudgetsAttributesTransfers,
            $restOrderBudgetSearchAttributesTransfer->getOrderBudgets(),
        );
    }
}
