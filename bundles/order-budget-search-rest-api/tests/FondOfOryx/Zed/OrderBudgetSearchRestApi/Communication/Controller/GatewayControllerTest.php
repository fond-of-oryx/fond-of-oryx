<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Communication\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\OrderBudgetSearchRestApiFacade;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Business\AbstractFacade;

class GatewayControllerTest extends Unit
{
    /**
     * @var (\FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\OrderBudgetSearchRestApiFacade&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiFacade|MockObject $facadeMock;

    /**
     * @var (\Generated\Shared\Transfer\OrderBudgetListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetListTransfer|MockObject $orderBudgetListTransferMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetSearchRestApi\Communication\Controller\GatewayController|\FondOfOryx\Zed\OrderBudgetSearchRestApi\Communication\Controller\__anonymous @1362
     */
    protected $gatewayController;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(OrderBudgetSearchRestApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetListTransferMock = $this->getMockBuilder(OrderBudgetListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->gatewayController = new class ($this->facadeMock) extends GatewayController {
            /**
             * @var \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected AbstractFacade $orderBudgetSearchRestApiFacade;

            /**
             * @param \Spryker\Zed\Kernel\Business\AbstractFacade $facade
             */
            public function __construct(AbstractFacade $facade)
            {
                $this->orderBudgetSearchRestApiFacade = $facade;
            }

            /**
             * @return \Spryker\Zed\Kernel\Business\AbstractFacade
             */
            protected function getFacade(): AbstractFacade
            {
                return $this->orderBudgetSearchRestApiFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testFindOrderBudgetsAction(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findOrderBudgets')
            ->with($this->orderBudgetListTransferMock)
            ->willReturn($this->orderBudgetListTransferMock);

        static::assertEquals(
            $this->orderBudgetListTransferMock,
            $this->gatewayController->findOrderBudgetsAction($this->orderBudgetListTransferMock),
        );
    }
}
