<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Facade;

use Codeception\Test\Unit;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class ErpInvoicePageSearchToEventBehaviorFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Dependency\Facade\ErpInvoicePageSearchToEventBehaviorFacadeInterface
     */
    protected $erpInvoicePageSearchToEventBehaviorFacadeBridge;

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

        $this->erpInvoicePageSearchToEventBehaviorFacadeBridge = new ErpInvoicePageSearchToEventBehaviorFacadeBridge(
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
            $this->erpInvoicePageSearchToEventBehaviorFacadeBridge->getEventTransferIds($eventTransfers),
        );
    }
}
