<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriterInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;

class CompanyBusinessUnitOrderBudgetFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetBusinessFactory
     */
    protected $businessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetBusinessFactory
     */
    protected $orderBudgetWriterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    protected $companyBusinessUnitTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetWriterMock = $this->getMockBuilder(OrderBudgetWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitTransferMock = $this->getMockBuilder(CompanyBusinessUnitTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyBusinessUnitOrderBudgetFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testCreateOrderBudgetForCompanyBusinessUnit(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createOrderBudgetWriter')
            ->willReturn($this->orderBudgetWriterMock);

        $this->orderBudgetWriterMock->expects(static::atLeastOnce())
            ->method('createForCompanyBusinessUnit')
            ->with($this->companyBusinessUnitTransferMock);

        $this->facade->createOrderBudgetForCompanyBusinessUnit($this->companyBusinessUnitTransferMock);
    }
}
