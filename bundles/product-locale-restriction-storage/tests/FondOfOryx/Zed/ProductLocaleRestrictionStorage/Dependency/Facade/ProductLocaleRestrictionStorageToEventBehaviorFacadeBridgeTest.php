<?php

namespace FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\EventEntityTransfer;
use Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface;

class ProductLocaleRestrictionStorageToEventBehaviorFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\EventBehavior\Business\EventBehaviorFacadeInterface
     */
    protected $eventBehaviorFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\EventEntityTransfer[]|\PHPUnit\Framework\MockObject\MockObject[]
     */
    protected $eventEntityTransferMocks;

    /**
     * @var \FondOfOryx\Zed\ProductLocaleRestrictionStorage\Dependency\Facade\ProductLocaleRestrictionStorageToEventBehaviorFacadeBridge
     */
    protected $productLocaleRestrictionStorageToEventBehaviorFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->eventBehaviorFacadeMock = $this->getMockBuilder(EventBehaviorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventEntityTransferMocks = [
            $this->getMockBuilder(EventEntityTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->productLocaleRestrictionStorageToEventBehaviorFacadeBridge = new ProductLocaleRestrictionStorageToEventBehaviorFacadeBridge(
            $this->eventBehaviorFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testGetEventTransferIds(): void
    {
        $eventTransferIds = [1, 2];

        $this->eventBehaviorFacadeMock->expects(static::atLeastOnce())
            ->method('getEventTransferIds')
            ->with($this->eventEntityTransferMocks)
            ->willReturn($eventTransferIds);

        static::assertEquals(
            $eventTransferIds,
            $this->productLocaleRestrictionStorageToEventBehaviorFacadeBridge->getEventTransferIds(
                $this->eventEntityTransferMocks
            )
        );
    }

    /**
     * @return void
     */
    public function testGetEventTransferForeignKeys(): void
    {
        $eventTransferForeignKeys = [2];
        $foreignKeyColumnName = 'foo';

        $this->eventBehaviorFacadeMock->expects(static::atLeastOnce())
            ->method('getEventTransferForeignKeys')
            ->with($this->eventEntityTransferMocks, $foreignKeyColumnName)
            ->willReturn($eventTransferForeignKeys);

        static::assertEquals(
            $eventTransferForeignKeys,
            $this->productLocaleRestrictionStorageToEventBehaviorFacadeBridge->getEventTransferForeignKeys(
                $this->eventEntityTransferMocks,
                $foreignKeyColumnName
            )
        );
    }
}
