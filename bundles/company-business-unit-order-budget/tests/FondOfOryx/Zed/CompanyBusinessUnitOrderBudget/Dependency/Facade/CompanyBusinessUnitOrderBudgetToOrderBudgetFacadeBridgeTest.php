<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface
     */
    protected $orderBudgetFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\OrderBudgetTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeBridge
     */
    protected $companyBusinessUnitOrderBudgetToOrderBudgetFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->orderBudgetFacadeMock = $this->getMockBuilder(OrderBudgetFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetTransferMock = $this->getMockBuilder(OrderBudgetTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitOrderBudgetToOrderBudgetFacadeBridge = new CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeBridge(
            $this->orderBudgetFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testCreateOrderBudget(): void
    {
        $this->orderBudgetFacadeMock->expects(static::atLeastOnce())
            ->method('createOrderBudget')
            ->with(null)
            ->willReturn($this->orderBudgetTransferMock);

        static::assertEquals(
            $this->orderBudgetTransferMock,
            $this->companyBusinessUnitOrderBudgetToOrderBudgetFacadeBridge->createOrderBudget()
        );
    }

    /**
     * @return void
     */
    public function testUpdateOrderBudget(): void
    {
        $this->orderBudgetFacadeMock->expects(static::atLeastOnce())
            ->method('updateOrderBudget')
            ->with($this->orderBudgetTransferMock);

        $this->companyBusinessUnitOrderBudgetToOrderBudgetFacadeBridge->updateOrderBudget(
            $this->orderBudgetTransferMock
        );
    }
}
