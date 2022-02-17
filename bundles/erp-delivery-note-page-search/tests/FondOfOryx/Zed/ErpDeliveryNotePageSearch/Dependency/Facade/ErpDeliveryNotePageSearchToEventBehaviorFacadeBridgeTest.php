<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade;

use Codeception\Test\Unit;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class ErpDeliveryNotePageSearchToEventBehaviorFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Dependency\Facade\ErpDeliveryNotePageSearchToEventBehaviorFacadeInterface
     */
    protected $erpDeliveryNotePageSearchToEventBehaviorFacadeBridge;

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

        $this->erpDeliveryNotePageSearchToEventBehaviorFacadeBridge = new ErpDeliveryNotePageSearchToEventBehaviorFacadeBridge(
            $this->eventBehaviorFacadeMock,
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
            $this->erpDeliveryNotePageSearchToEventBehaviorFacadeBridge->getEventTransferIds($eventTransfers),
        );
    }
}
