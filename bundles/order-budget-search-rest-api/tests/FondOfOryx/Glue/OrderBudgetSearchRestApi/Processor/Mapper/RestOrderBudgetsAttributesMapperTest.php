<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RestOrderBudgetsAttributesMapperTest extends Unit
{
    /**
     * @var (\Generated\Shared\Transfer\OrderBudgetListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetListTransfer|MockObject $orderBudgetListTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\OrderBudgetTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetTransfer|MockObject $orderBudgetTransferMock;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetsAttributesMapper
     */
    protected RestOrderBudgetsAttributesMapper $restOrderBudgetsAttributesMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->orderBudgetListTransferMock = $this->getMockBuilder(OrderBudgetListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetTransferMock = $this->getMockBuilder(OrderBudgetTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetsAttributesMapper = new RestOrderBudgetsAttributesMapper();
    }

    /**
     * @return void
     */
    public function testFromOrderBudgetList(): void
    {
        $data = [];
        $uuid = '48981b6c-d230-4400-8e2e-ba7fe0005e4e';
        $orderBudgetTransferMocks = new ArrayObject([$this->orderBudgetTransferMock]);

        $this->orderBudgetListTransferMock->expects(static::atLeastOnce())
            ->method('getOrderBudgets')
            ->willReturn($orderBudgetTransferMocks);

        $this->orderBudgetTransferMock->expects(static::atLeastOnce())
            ->method('getUuid')
            ->willReturn($uuid);

        $this->orderBudgetTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $restOrderBudgetsAttributesTransfers = $this->restOrderBudgetsAttributesMapper->fromOrderBudgetList(
            $this->orderBudgetListTransferMock,
        );

        static::assertCount(1, $restOrderBudgetsAttributesTransfers);
    }
}
