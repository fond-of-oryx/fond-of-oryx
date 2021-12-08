<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeBridge;
use Generated\Shared\Transfer\AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class SubscribeToBackInStockHandlerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\SubscribeToBackInStockHandler
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();

        $this->handler = new SubscribeToBackInStockHandler($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testSendSubscribeToBackInStockEvent(): void
    {
        $this->facadeMock->expects(static::once())->method('dispatchSubscription');
        $this->subscriptionTransferMock->expects(static::once())->method('setEventType')->with('subscribed-to-back-in-stock')->willReturnSelf();

        $transfer = $this->handler->sendSubscribeToBackInStockEvent($this->subscriptionTransferMock);

        static::assertInstanceOf(AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer::class, $transfer);
        static::assertTrue($transfer->getStatus());
    }

    /**
     * @return void
     */
    public function testSendSubscribeToBackInStockEventWillFail(): void
    {
        $this->facadeMock->expects(static::once())->method('dispatchSubscription')->willThrowException(new Exception('test'));

        $transfer = $this->handler->sendSubscribeToBackInStockEvent($this->subscriptionTransferMock);

        static::assertInstanceOf(AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer::class, $transfer);
        static::assertFalse($transfer->getStatus());
    }
}
