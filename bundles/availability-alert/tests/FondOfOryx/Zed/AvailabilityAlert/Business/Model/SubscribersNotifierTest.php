<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutor;
use FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToAvailabilityFacadeBridge;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionCollectionTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\ProductAbstractAvailabilityTransfer;
use Spryker\DecimalObject\Decimal;

class SubscribersNotifierTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\AvailabilityAlertSubscriptionCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductAbstractAvailabilityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $availabilityTransferMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $executorMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Dependency\Facade\AvailabilityAlertToAvailabilityFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $availabilityFacadeMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\NotificationHandlerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $notificationHandlerMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $subscriptionManagerMock;

    /**
     * @var \Spryker\DecimalObject\Decimal|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $decimalMock;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifierInterface
     */
    protected $notifier;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->subscriptionTransferMock = static::getMockBuilder(AvailabilityAlertSubscriptionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionCollectionTransferMock = static::getMockBuilder(AvailabilityAlertSubscriptionCollectionTransfer::class)->disableOriginalConstructor()->getMock();
        $this->executorMock = static::getMockBuilder(SubscribersNotifierPluginExecutor::class)->disableOriginalConstructor()->getMock();
        $this->availabilityFacadeMock = static::getMockBuilder(AvailabilityAlertToAvailabilityFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->notificationHandlerMock = static::getMockBuilder(NotificationHandler::class)->disableOriginalConstructor()->getMock();
        $this->subscriptionManagerMock = static::getMockBuilder(SubscriptionManager::class)->disableOriginalConstructor()->getMock();
        $this->decimalMock = static::getMockBuilder(Decimal::class)->disableOriginalConstructor()->getMock();
        $this->availabilityTransferMock = static::getMockBuilder(ProductAbstractAvailabilityTransfer::class)->disableOriginalConstructor()->getMock();

        $this->notifier = new SubscribersNotifier($this->availabilityFacadeMock, $this->notificationHandlerMock, $this->subscriptionManagerMock, 50, $this->executorMock);
    }

    /**
     * @return void
     */
    public function testNotify(): void
    {
        $self = $this;
        $subscriptionCount = [
            1 => 5,
            2 => 2,
        ];
        $subscriptionTransferClone = clone $this->subscriptionTransferMock;
        $this->subscriptionTransferMock->expects(static::atLeastOnce())->method('getFkProductAbstract')->willReturn(1);
        $this->subscriptionTransferMock->expects(static::atLeastOnce())->method('getFkLocale')->willReturn(1);
        $this->subscriptionTransferMock->expects(static::atLeastOnce())->method('setSentAt')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionTransferMock->expects(static::atLeastOnce())->method('setStatus')->willReturn($this->subscriptionTransferMock);
        $subscriptionTransferClone->expects(static::atLeastOnce())->method('getFkProductAbstract')->willReturn(2);
        $subscriptionTransferClone->expects(static::atLeastOnce())->method('getFkLocale')->willReturn(1);
        $subscriptionTransferClone->expects(static::never())->method('setSentAt');
        $subscriptionTransferClone->expects(static::never())->method('setStatus');
        $this->subscriptionManagerMock->expects(static::once())->method('getCurrentSubscriptionCountPerProductAbstract')->willReturn($subscriptionCount);
        $this->subscriptionManagerMock->expects(static::once())->method('getSubscriptionsForCurrentStoreAndStatus')->willReturn($this->subscriptionCollectionTransferMock);
        $this->subscriptionCollectionTransferMock->expects(static::once())->method('getSubscriptions')->willReturn([$this->subscriptionTransferMock, $subscriptionTransferClone]);
        $this->executorMock->expects(static::once())->method('executePreCheckPlugins')->willReturn(true);
        $this->notificationHandlerMock->expects(static::once())->method('execute');
        $this->subscriptionManagerMock->expects(static::once())->method('updateSubscription');
        $this->availabilityFacadeMock->expects(static::exactly(2))->method('getProductAbstractAvailability')->willReturnCallback(static function (int $fkProd, int $fkLocale) use ($self) {
            $decimal = clone $self->decimalMock;
            $availability = clone $self->availabilityTransferMock;
            if ($fkProd === 1) {
                $decimal->expects(static::once())->method('toInt')->willReturn(3);
                $availability->expects(static::once())->method('getAvailability')->willReturn($decimal);

                return $availability;
            }
            $decimal->expects(static::once())->method('toInt')->willReturn(0);
            $availability->expects(static::once())->method('getAvailability')->willReturn($decimal);

            return $availability;
        });

        $this->notifier->notify();
    }

    /**
     * @return void
     */
    public function testNotifyWithPluginCheckNotPass(): void
    {
        $subscriptionCount = [
            1 => 5,
        ];
        $this->subscriptionTransferMock->expects(static::atLeastOnce())->method('getFkProductAbstract')->willReturn(1);
        $this->subscriptionTransferMock->expects(static::atLeastOnce())->method('getFkLocale')->willReturn(1);
        $this->subscriptionTransferMock->expects(static::never())->method('setSentAt')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionTransferMock->expects(static::never())->method('setStatus')->willReturn($this->subscriptionTransferMock);
        $this->subscriptionManagerMock->expects(static::once())->method('getCurrentSubscriptionCountPerProductAbstract')->willReturn($subscriptionCount);
        $this->subscriptionManagerMock->expects(static::once())->method('getSubscriptionsForCurrentStoreAndStatus')->willReturn($this->subscriptionCollectionTransferMock);
        $this->subscriptionCollectionTransferMock->expects(static::once())->method('getSubscriptions')->willReturn([$this->subscriptionTransferMock]);
        $this->executorMock->expects(static::once())->method('executePreCheckPlugins')->willReturn(false);
        $this->notificationHandlerMock->expects(static::never())->method('execute');
        $this->subscriptionManagerMock->expects(static::never())->method('updateSubscription');
        $this->decimalMock->expects(static::once())->method('toInt')->willReturn(3);
        $this->availabilityTransferMock->expects(static::once())->method('getAvailability')->willReturn($this->decimalMock);
        $this->availabilityFacadeMock->expects(static::exactly(1))->method('getProductAbstractAvailability')->willReturn($this->availabilityTransferMock);

        $this->notifier->notify();
    }
}
