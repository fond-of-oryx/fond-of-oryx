<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\AvailabilityAlertCrossEngage\Dependency\Facade\AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeBridge;
use Generated\Shared\Transfer\AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class NotificationHandlerTest extends Unit
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
     * @var \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\Handler\NotificationHandler
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->facadeMock = static::getMockBuilder(AvailabilityAlertCrossEngageToJellyfishAvailabilityAlertFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionTransferMock = static::getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();

        $this->handler = new NotificationHandler($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testSendSubscription(): void
    {
        $this->facadeMock->expects(static::once())->method('dispatchSubscription');

        $transfer = $this->handler->sendSubscription($this->subscriptionTransferMock);

        static::assertInstanceOf(AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer::class, $transfer);
        static::assertTrue($transfer->getStatus());
    }

    /**
     * @return void
     */
    public function testSendSubscriptionWillFail(): void
    {
        $this->facadeMock->expects(static::once())->method('dispatchSubscription')->willThrowException(new Exception('test'));

        $transfer = $this->handler->sendSubscription($this->subscriptionTransferMock);

        static::assertInstanceOf(AvailabilityAlertCrossEngageDispatchSubscriptionResponseTransfer::class, $transfer);
        static::assertFalse($transfer->getStatus());
    }
}
