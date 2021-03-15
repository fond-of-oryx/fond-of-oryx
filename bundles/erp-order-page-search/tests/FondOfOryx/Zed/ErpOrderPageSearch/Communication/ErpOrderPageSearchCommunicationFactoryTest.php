<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderPageSearch\Communication\ErpOrderPageSearchCommunicationFactory;
use FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Facade\ErpOrderPageSearchToEventBehaviorFacadeInterface;
use Spryker\Zed\Kernel\Container;

class ErpOrderPageSearchCommunicationFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Communication\ErpOrderPageSearchCommunicationFactory
     */
    protected $erpOrderPageSearchCommunicationFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Facade\ErpOrderPageSearchToEventBehaviorFacadeInterface
     */
    protected $erpOrderPageSearchToEventBehaviorFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToEventBehaviorFacadeMock = $this->getMockBuilder(ErpOrderPageSearchToEventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderQueryMock = $this->getMockBuilder(ErpOrderQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchCommunicationFactory = new ErpOrderPageSearchCommunicationFactory();
        $this->erpOrderPageSearchCommunicationFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetEventBehaviorFacade()
    {
        $this->containerMock->expects(static::atLeastOnce())
            ->method('has')
            ->with(ErpOrderPageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR)
            ->willReturn(true);

        $this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(ErpOrderPageSearchDependencyProvider::FACADE_EVENT_BEHAVIOR)
            ->willReturn($this->erpOrderPageSearchToEventBehaviorFacadeMock);

        $this->assertInstanceOf(
            ErpOrderPageSearchToEventBehaviorFacadeInterface::class,
            $this->erpOrderPageSearchCommunicationFactory->getEventBehaviorFacade()
        );
    }
}
