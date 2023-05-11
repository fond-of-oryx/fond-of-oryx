<?php

namespace FondOfOryx\Client\OrderBudgetSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToZedRequestClientInterface;
use FondOfOryx\Client\OrderBudgetSearchRestApi\Zed\OrderBudgetSearchRestApiStub;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Client\Kernel\Container;

class OrderBudgetSearchRestApiFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Client\Kernel\Container&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MockObject|Container $containerMock;

    /**
     * @var (\FondOfOryx\Client\OrderBudgetSearchRestApi\Dependency\Client\OrderBudgetSearchRestApiToZedRequestClientInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiToZedRequestClientInterface|MockObject $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiFactory
     */
    protected OrderBudgetSearchRestApiFactory $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(OrderBudgetSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new OrderBudgetSearchRestApiFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateZedOrderBudgetSearchRestApiStub(): void
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(OrderBudgetSearchRestApiDependencyProvider::CLIENT_ZED_REQUEST)
            ->willReturn($this->zedRequestClientMock);

        static::assertInstanceOf(
            OrderBudgetSearchRestApiStub::class,
            $this->factory->createZedOrderBudgetSearchRestApiStub(),
        );
    }
}
