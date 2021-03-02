<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutorInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\Map\FooAvailabilityAlertSubscriptionTableMap;
use Spryker\DecimalObject\Decimal;
use Spryker\Zed\Availability\Business\AvailabilityFacadeInterface;

class SubscribersNotifier implements SubscribersNotifierInterface
{
    /**
     * @var \Spryker\Zed\Availability\Business\AvailabilityFacadeInterface
     */
    protected $availabilityFacade;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManagerInterface
     */
    protected $subscriptionManager;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\NotificationHandlerInterface
     */
    protected $notificationHandler;

    /**
     * @var int
     */
    protected $minimalPercentageDifference;

    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutorInterface
     */
    protected $subscribersNotifierPluginExecutor;

    /**
     * @param \Spryker\Zed\Availability\Business\AvailabilityFacadeInterface $availabilityFacade
     * @param \FondOfOryx\Zed\AvailabilityAlert\Business\Model\NotificationHandlerInterface $notificationHandler
     * @param \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscriptionManagerInterface $subscriptionManager
     * @param int $minimalPercentageDifference
     * @param \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\SubscribersNotifierPluginExecutorInterface $subscribersNotifierPluginExecutor
     */
    public function __construct(
        AvailabilityFacadeInterface $availabilityFacade,
        NotificationHandlerInterface $notificationHandler,
        SubscriptionManagerInterface $subscriptionManager,
        int $minimalPercentageDifference,
        SubscribersNotifierPluginExecutorInterface $subscribersNotifierPluginExecutor
    ) {
        $this->availabilityFacade = $availabilityFacade;
        $this->notificationHandler = $notificationHandler;
        $this->subscriptionManager = $subscriptionManager;
        $this->minimalPercentageDifference = $minimalPercentageDifference;
        $this->subscribersNotifierPluginExecutor = $subscribersNotifierPluginExecutor;
    }

    /**
     * @return \FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifierInterface
     */
    public function notify(): SubscribersNotifierInterface
    {
        $countOfSubscriberPerProductAbstract = $this->subscriptionManager->getCurrentSubscriptionCountPerProductAbstract();

        foreach ($this->subscriptionManager->getSubscriptionsForCurrentStoreAndStatus(0)->getSubscriptions() as $availabilityAlertSubscriptionTransfer) {
            if (
                !$this->canSendNotification(
                    $availabilityAlertSubscriptionTransfer,
                    $countOfSubscriberPerProductAbstract
                )
            ) {
                continue;
            }

            $isPassed = $this->subscribersNotifierPluginExecutor->executePreCheckPlugins($availabilityAlertSubscriptionTransfer);

            if ($isPassed === false) {
                continue;
            }

            $this->sendNotification($availabilityAlertSubscriptionTransfer);
        }

        return $this;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    protected function sendNotification(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void
    {
        $this->notificationHandler->execute($availabilityAlertSubscriptionTransfer);

        $availabilityAlertSubscriptionTransfer->setSentAt(time())
            ->setStatus(FooAvailabilityAlertSubscriptionTableMap::COL_STATUS_NOTIFIED);

        $this->subscriptionManager->updateSubscription($availabilityAlertSubscriptionTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     * @param array $countOfSubscriberPerProductAbstract
     *
     * @return bool
     */
    protected function canSendNotification(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer,
        array $countOfSubscriberPerProductAbstract
    ): bool {
        $percentageDifference = $this->calculatePercentageDifference(
            $availabilityAlertSubscriptionTransfer,
            $countOfSubscriberPerProductAbstract
        );

        return $percentageDifference > $this->minimalPercentageDifference;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     * @param array $countOfSubscriberPerProductAbstract
     *
     * @return float
     */
    protected function calculatePercentageDifference(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer,
        array $countOfSubscriberPerProductAbstract
    ): float {
        $fkProductAbstract = $availabilityAlertSubscriptionTransfer->getFkProductAbstract();
        $subscriberCount = $countOfSubscriberPerProductAbstract[$fkProductAbstract];
        $availability = $this->getAvailability($availabilityAlertSubscriptionTransfer)->toInt();

        return (float)($availability * 100 / $subscriberCount);
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return \Spryker\DecimalObject\Decimal|null
     */
    protected function getAvailability(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): ?Decimal {
        $productAbstractAvailability = $this->availabilityFacade->getProductAbstractAvailability(
            $availabilityAlertSubscriptionTransfer->getFkProductAbstract(),
            $availabilityAlertSubscriptionTransfer->getFkLocale()
        );

        return $productAbstractAvailability->getAvailability();
    }
}
