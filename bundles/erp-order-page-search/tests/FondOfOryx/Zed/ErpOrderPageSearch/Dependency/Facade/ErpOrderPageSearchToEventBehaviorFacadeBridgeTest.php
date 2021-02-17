<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Facade;

use Codeception\Test\Unit;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class ErpOrderPageSearchToEventBehaviorFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Dependency\Facade\ErpOrderPageSearchToEventBehaviorFacadeInterface
     */
    protected $erpOrderPageSearchToEventBehaviorFacadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected $eventBehaviorFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->eventBehaviorFacadeMock = $this->getMockBuilder(EventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderPageSearchToEventBehaviorFacadeBridge = new ErpOrderPageSearchToEventBehaviorFacadeBridge(
            $this->eventBehaviorFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetEventTransferIds(): void
    {
        $eventTransfers = [];

        $this->eventBehaviorFacadeMock->expects(static::atLeastOnce())
            ->method('getEventTransferIds')
            ->willReturn([]);

        $this->assertIsArray(
            $this->erpOrderPageSearchToEventBehaviorFacadeBridge->getEventTransferIds($eventTransfers)
        );
    }
}
