<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Mapper;

use Codeception\Test\Unit;
use DateTime;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class OrderBudgetHistoryMapperTest extends Unit
{
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

        $now = (new DateTime())->format('Y-m-d H:i:s');

        $this->orderBudgetData = [
            'id_order_budget' => 1,
            'budget' => 20000,
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $this->orderBudgetHistoryData = [
            'id_order_budget_history' => null,
            'fk_order_budget' => 1,
            'budget' => 20000,
            'from' => $now,
            'to' => null,
        ];

        $this->orderBudgetHistoryMapper = new OrderBudgetHistoryMapper();
    }

    /**
     * @return void
     */
    public function testFromOrderBudget(): void
    {
        $orderBudgetHistoryTransfer = $this->orderBudgetHistoryMapper->fromOrderBudget(
            (new OrderBudgetTransfer())->fromArray($this->orderBudgetData, true),
        );

        static::assertEquals($this->orderBudgetHistoryData, $orderBudgetHistoryTransfer->toArray(true));
    }
}
