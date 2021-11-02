<?php

namespace FondOfOryx\Zed\OrderBudget\Business\Writer;

use Codeception\Test\Unit;
use FondOfOryx\Shared\OrderBudget\OrderBudgetConstants;
use FondOfOryx\Zed\OrderBudget\OrderBudgetConfig;
use FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class OrderBudgetWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OrderBudget\Persistence\OrderBudgetEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\OrderBudgetConfig|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $configMock;

    /**
     * @var \Generated\Shared\Transfer\OrderBudgetTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $orderBudgetTransferMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudget\Business\Writer\OrderBudgetWriter
     */
    protected $orderBudgetWriter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(OrderBudgetEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(OrderBudgetConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetTransferMock = $this->getMockBuilder(OrderBudgetTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetWriter = new OrderBudgetWriter($this->entityManagerMock, $this->configMock);
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getInitialBudget')
            ->willReturn(OrderBudgetConstants::INITIAL_BUDGET_DEFAULT);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createOrderBudget')
            ->with(
                static::callback(
                    static function (OrderBudgetTransfer $orderBudgetTransfer) {
                        return $orderBudgetTransfer->getBudget() === OrderBudgetConstants::INITIAL_BUDGET_DEFAULT;
                    },
                ),
            )->willReturn($this->orderBudgetTransferMock);

        static::assertEquals($this->orderBudgetTransferMock, $this->orderBudgetWriter->create());
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateOrderBudget')
            ->with($this->orderBudgetTransferMock);

        $this->orderBudgetWriter->update($this->orderBudgetTransferMock);
    }
}
