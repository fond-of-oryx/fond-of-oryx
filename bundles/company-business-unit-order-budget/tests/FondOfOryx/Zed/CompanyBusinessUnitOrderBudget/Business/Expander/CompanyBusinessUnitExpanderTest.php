<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class CompanyBusinessUnitExpanderTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderBudgetTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $orderBudgetFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\CompanyBusinessUnitExpander
     */
    protected $companyBusinessUnitExpander;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetTransferMock = $this->getMockBuilder(OrderBudgetTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetFacadeMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitExpander = new CompanyBusinessUnitExpander(
            $this->orderBudgetFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $fkOrderBudget = 1;

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getFkOrderBudget')
            ->willReturn($fkOrderBudget);

        $this->orderBudgetFacadeMock->expects(static::atLeastOnce())
            ->method('findOrderBudgetByIdOrderBudget')
            ->with($fkOrderBudget)
            ->willReturn($this->orderBudgetTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('setOrderBudget')
            ->with($this->orderBudgetTransferMock)
            ->willReturn($this->companyBusinessUnitTransferMock);

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $this->companyBusinessUnitExpander->expand($this->companyBusinessUnitTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutFkOrderBudget(): void
    {
        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getFkOrderBudget')
            ->willReturn(null);

        $this->orderBudgetFacadeMock->expects(static::never())
            ->method('findOrderBudgetByIdOrderBudget');

        $this->companyBusinessUnitTransferMock->expects(static::never())
            ->method('setOrderBudget');

        static::assertEquals(
            $this->companyBusinessUnitTransferMock,
            $this->companyBusinessUnitExpander->expand($this->companyBusinessUnitTransferMock),
        );
    }
}
