<?php

namespace FondOfOryx\Zed\SalesLocaleConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SalesLocaleConnector\Business\Model\OrderExpander;
use FondOfOryx\Zed\SalesLocaleConnector\Dependency\Facade\SalesLocaleConnectorToLocaleFacadeInterface;
use FondOfOryx\Zed\SalesLocaleConnector\SalesLocaleConnectorDependencyProvider;
use Spryker\Zed\Kernel\Container;

class SalesLocaleConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\SalesLocaleConnector\Dependency\Facade\SalesLocaleConnectorToLocaleFacadeInterface
     */
    protected $localeFacadeMock;

    /**
     * @var \FondOfSpryker\Zed\SalesLocaleConnector\Business\SalesLocaleConnectorBusinessFactory
     */
    protected $salesLocaleConnectorBusinessFactory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeFacadeMock = $this->getMockBuilder(SalesLocaleConnectorToLocaleFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->salesLocaleConnectorBusinessFactory = new SalesLocaleConnectorBusinessFactory();
        $this->salesLocaleConnectorBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateOrderExpander(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(SalesLocaleConnectorDependencyProvider::FACADE_LOCALE)
            ->willReturn($this->localeFacadeMock);

        $orderExpander = $this->salesLocaleConnectorBusinessFactory->createOrderExpander();

        $this->assertInstanceOf(OrderExpander::class, $orderExpander);
    }
}
