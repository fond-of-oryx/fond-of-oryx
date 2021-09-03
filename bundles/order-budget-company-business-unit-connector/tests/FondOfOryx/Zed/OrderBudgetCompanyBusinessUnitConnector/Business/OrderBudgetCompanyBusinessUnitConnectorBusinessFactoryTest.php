<?php

namespace FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\Writer\OrderBudgetWriter;
use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade\OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\OrderBudgetCompanyBusinessUnitConnectorDependencyProvider;
use FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Persistence\OrderBudgetCompanyBusinessUnitConnectorEntityManager;
use Spryker\Zed\Kernel\Container;

class OrderBudgetCompanyBusinessUnitConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Persistence\OrderBudgetCompanyBusinessUnitConnectorEntityManager|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Dependency\Facade\OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderBudgetFacadeMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetCompanyBusinessUnitConnector\Business\OrderBudgetCompanyBusinessUnitConnectorBusinessFactory
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

        $this->entityManagerMock = $this->getMockBuilder(OrderBudgetCompanyBusinessUnitConnectorEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetFacadeMock = $this->getMockBuilder(OrderBudgetCompanyBusinessUnitConnectorToOrderBudgetFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new OrderBudgetCompanyBusinessUnitConnectorBusinessFactory();
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
            ->with(OrderBudgetCompanyBusinessUnitConnectorDependencyProvider::FACADE_ORDER_BUDGET)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(OrderBudgetCompanyBusinessUnitConnectorDependencyProvider::FACADE_ORDER_BUDGET)
            ->willReturn($this->orderBudgetFacadeMock);

        static::assertInstanceOf(
            OrderBudgetWriter::class,
            $this->businessFactory->createOrderBudgetWriter()
        );
    }
}
