<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\OrderBudgetTransfer;

class OrderBudgetWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $orderBudgetFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderBudgetTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $orderBudgetTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriter
     */
    protected $orderBudgetWriter;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->orderBudgetFacadeMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetEntityManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetTransferMock = $this->getMockBuilder(OrderBudgetTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetWriter = new OrderBudgetWriter(
            $this->orderBudgetFacadeMock,
            $this->entityManagerMock,
        );
    }

    /**
     * @return void
     */
    public function testCreateForCompanyBusinessUnit(): void
    {
        $idOrderBudget = 1;

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getFkOrderBudget')
            ->willReturn(null);

        $this->orderBudgetFacadeMock->expects(static::atLeastOnce())
            ->method('createOrderBudget')
            ->willReturn($this->orderBudgetTransferMock);

        $this->orderBudgetTransferMock->expects(static::atLeastOnce())
            ->method('getIdOrderBudget')
            ->willReturn($idOrderBudget);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('setFkOrderBudget')
            ->with($idOrderBudget)
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('setOrderBudget')
            ->with($this->orderBudgetTransferMock)
            ->willReturn($this->companyBusinessUnitTransferMock);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('assignOrderBudgetToCompanyBusinessUnit')
            ->with($this->companyBusinessUnitTransferMock);

        $this->orderBudgetWriter->createForCompanyBusinessUnit($this->companyBusinessUnitTransferMock);
    }

    /**
     * @return void
     */
    public function testCreateForCompanyBusinessUnitWithExistingOrderBudget(): void
    {
        $idOrderBudget = 1;

        $this->companyBusinessUnitTransferMock->expects(static::atLeastOnce())
            ->method('getFkOrderBudget')
            ->willReturn($idOrderBudget);

        $this->orderBudgetFacadeMock->expects(static::never())
            ->method('createOrderBudget');

        $this->companyBusinessUnitTransferMock->expects(static::never())
            ->method('setFkOrderBudget');

        $this->companyBusinessUnitTransferMock->expects(static::never())
            ->method('setOrderBudget');

        $this->entityManagerMock->expects(static::never())
            ->method('assignOrderBudgetToCompanyBusinessUnit');

        $this->orderBudgetWriter->createForCompanyBusinessUnit($this->companyBusinessUnitTransferMock);
    }
}
