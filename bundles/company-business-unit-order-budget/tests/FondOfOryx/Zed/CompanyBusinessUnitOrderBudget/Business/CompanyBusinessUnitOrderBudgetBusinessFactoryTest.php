<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Expander\QuoteExpander;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reducer\OrderBudgetReducer;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Validator\QuoteValidator;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer\OrderBudgetWriter;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\CompanyBusinessUnitOrderBudgetDependencyProvider;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManager;
use Spryker\Zed\Kernel\Container;

class CompanyBusinessUnitOrderBudgetBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $permissionFacadeMock;

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

        $this->permissionFacadeMock = $this->getMockBuilder(CompanyBusinessUnitOrderBudgetToPermissionFacadeInterface::class)
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

    /**
     * @return void
     */
    public function testCreateQuoteExpander(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_PERMISSION)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_PERMISSION)
            ->willReturn($this->permissionFacadeMock);

        static::assertInstanceOf(
            QuoteExpander::class,
            $this->businessFactory->createQuoteExpander()
        );
    }

    /**
     * @return void
     */
    public function testCreateQuoteValidator(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_PERMISSION)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_PERMISSION)
            ->willReturn($this->permissionFacadeMock);

        static::assertInstanceOf(
            QuoteValidator::class,
            $this->businessFactory->createQuoteValidator()
        );
    }

    /**
     * @return void
     */
    public function testCreateOrderBudgetReducer(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive(
                [CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_ORDER_BUDGET],
                [CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_PERMISSION]
            )->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_ORDER_BUDGET],
                [CompanyBusinessUnitOrderBudgetDependencyProvider::FACADE_PERMISSION]
            )->willReturnOnConsecutiveCalls(
                $this->orderBudgetFacadeMock,
                $this->permissionFacadeMock
            );

        static::assertInstanceOf(
            OrderBudgetReducer::class,
            $this->businessFactory->createOrderBudgetReducer()
        );
    }
}
