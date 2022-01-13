<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class OrderBudgetHistoryMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OrderBudget\Dependency\Service\OrderBudgetToUtilDateTimeServiceInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $utilDateTimeServiceMock;

    /**
     * @var array
     */
    protected $orderBudgetData;

    /**
     * @var array
     */
    protected $orderBudgetHistoryData;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\Mapper\OrderBudgetHistoryMapper
     */
    protected $orderBudgetHistoryMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->utilDateTimeServiceMock = $this->getMockBuilder(OrderBudgetToUtilDateTimeServiceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetData = [
            'id_order_budget' => 1,
            'budget' => 20000,
            'created_at' => '2022-01-01 02:00:00',
            'updated_at' => '2022-01-01 02:00:00',
        ];

        $this->orderBudgetHistoryData = [
            'id_order_budget_history' => null,
            'fk_order_budget' => 1,
            'budget' => 20000,
            'from' => '2022-01-01',
            'to' => null,
        ];

        $this->orderBudgetHistoryMapper = new OrderBudgetHistoryMapper(
            $this->utilDateTimeServiceMock,
        );
    }

    /**
     * @return void
     */
    public function testFromOrderBudget(): void
    {
        $this->utilDateTimeServiceMock->expects(static::atLeastOnce())
            ->method('formatDate')
            ->with($this->orderBudgetData['updated_at'])
            ->willReturn($this->orderBudgetHistoryData['from']);

        $orderBudgetHistoryTransfer = $this->orderBudgetHistoryMapper->fromOrderBudget(
            (new OrderBudgetTransfer())->fromArray($this->orderBudgetData, true),
        );

        static::assertEquals($this->orderBudgetHistoryData, $orderBudgetHistoryTransfer->toArray(true));
    }
}
