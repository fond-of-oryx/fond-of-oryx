<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudget\Business\OrderBudgetFacadeInterface;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeBridgeTest extends Unit
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
     * @var \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade\OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeBridge
     */
    protected $orderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeBridge;

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

        $this->orderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeBridge = new OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeBridge(
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
            $this->orderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeBridge->createOrderBudget()
        );
    }
}
