<?php

namespace FondOfOryx\Zed\OrderBudgetSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\Reader\OrderBudgetReader;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade\OrderBudgetSearchRestApiToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiDependencyProvider;
use FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\OrderBudgetSearchRestApiRepository;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Kernel\Container;

class OrderBudgetSearchRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected Container|MockObject $containerMock;

    /**
     * @var (\FondOfOryx\Zed\OrderBudgetSearchRestApi\Persistence\OrderBudgetSearchRestApiRepository&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiRepository|MockObject $repositoryMock;

    /**
     * @var (\FondOfOryx\Zed\OrderBudgetSearchRestApi\Dependency\Facade\OrderBudgetSearchRestApiToOrderBudgetFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiToOrderBudgetFacadeInterface|MockObject $orderBudgetFacadeMock;

    /**
     * @var \FondOfOryx\Zed\OrderBudgetSearchRestApi\Business\OrderBudgetSearchRestApiBusinessFactory
     */
    protected OrderBudgetSearchRestApiBusinessFactory $factory;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repositoryMock = $this->getMockBuilder(OrderBudgetSearchRestApiRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetFacadeMock = $this->getMockBuilder(OrderBudgetSearchRestApiToOrderBudgetFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new OrderBudgetSearchRestApiBusinessFactory();
        $this->factory->setContainer($this->containerMock);
        $this->factory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateOrderBudgetReader(): void
    {
        $plugins = [];

        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->withConsecutive([
                OrderBudgetSearchRestApiDependencyProvider::FACADE_ORDER_BUDGET,
            ], [
                OrderBudgetSearchRestApiDependencyProvider::PLUGINS_SEARCH_ORDER_BUDGET_QUERY_EXPANDER,
            ])->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive([
                OrderBudgetSearchRestApiDependencyProvider::FACADE_ORDER_BUDGET,
            ], [
                OrderBudgetSearchRestApiDependencyProvider::PLUGINS_SEARCH_ORDER_BUDGET_QUERY_EXPANDER,
            ])->willReturnOnConsecutiveCalls(
                $this->orderBudgetFacadeMock,
                $plugins,
            );

        static::assertInstanceOf(
            OrderBudgetReader::class,
            $this->factory->createOrderBudgetReader(),
        );
    }
}
