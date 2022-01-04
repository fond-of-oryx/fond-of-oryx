<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\Validation\ValidationPluginExecutor;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class SubscriptionRequestHandlerTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionManagerMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\Validation\ValidationPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $validatorMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionRequestHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->subscriptionTransferMock = $this->getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionManagerMock = $this->getMockBuilder(SubscriptionManager::class)->disableOriginalConstructor()->getMock();
        $this->validatorMock = $this->getMockBuilder(ValidationPluginExecutor::class)->disableOriginalConstructor()->getMock();

        $this->handler = new SubscriptionRequestHandler($this->subscriptionManagerMock, $this->validatorMock);
    }

    /**
     * @return void
     */
    public function testProcessAvailabilityAlertSubscription(): void
    {
        $this->subscriptionManagerMock->expects(static::once())->method('isAlreadySubscribed')->willReturn(false);
        $this->subscriptionManagerMock->expects(static::once())->method('subscribe');
        $this->validatorMock->expects(static::once())->method('validate');

        $response = $this->handler->processAvailabilityAlertSubscription($this->subscriptionTransferMock);
        static::assertInstanceOf(AvailabilityAlertSubscriptionResponseTransfer::class, $response);
        static::assertTrue($response->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testProcessAvailabilityAlertSubscriptionAlreadySubscribed(): void
    {
        $this->subscriptionManagerMock->expects(static::once())->method('isAlreadySubscribed')->willReturn(true);
        $this->subscriptionManagerMock->expects(static::never())->method('subscribe');
        $this->validatorMock->expects(static::once())->method('validate');

        $response = $this->handler->processAvailabilityAlertSubscription($this->subscriptionTransferMock);
        static::assertInstanceOf(AvailabilityAlertSubscriptionResponseTransfer::class, $response);
        static::assertTrue($response->getIsSuccess());
    }

    /**
     * @return void
     */
    public function testProcessAvailabilityAlertSubscriptionWillFail(): void
    {
        $this->subscriptionManagerMock->expects(static::once())->method('isAlreadySubscribed')->willReturn(false);
        $this->subscriptionManagerMock->expects(static::once())->method('subscribe')->willThrowException(new Exception('Error'));
        $this->validatorMock->expects(static::once())->method('validate');

        $response = $this->handler->processAvailabilityAlertSubscription($this->subscriptionTransferMock);
        static::assertInstanceOf(AvailabilityAlertSubscriptionResponseTransfer::class, $response);
        static::assertFalse($response->getIsSuccess());
    }
}
