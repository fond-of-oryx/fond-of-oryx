<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriter;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\CompanyBusinessUnitOrderBudgetDependencyProvider;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManager;
use Spryker\Zed\Kernel\Container;

class CompanyBusinessUnitOrderBudgetBusinessFactoryTest extends Unit
{
    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManager|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\CompanyBusinessUnitOrderBudgetBusinessFactory
     */
    protected $businessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetFacadeMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new CompanyBusinessUnitOrderBudgetBusinessFactory();
        $this->businessFactory->setContainer($this->containerMock);
        $this->businessFactory->setEntityManager($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreateOrderBudgetWriter(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_ORDER_BUDGET)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_ORDER_BUDGET)
            ->willReturn($this->orderBudgetFacadeMock);

        static::assertInstanceOf(
            OrderBudgetWriter::class,
            $this->businessFactory->createOrderBudgetWriter()
        );
    }
}
