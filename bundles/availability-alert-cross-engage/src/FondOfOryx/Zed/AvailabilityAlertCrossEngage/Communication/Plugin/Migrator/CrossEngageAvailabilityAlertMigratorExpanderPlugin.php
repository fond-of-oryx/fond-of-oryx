<?php

namespace FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\Plugin\Migrator;

use Exception;
use FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Plugin\AvailabilityAlertMigratorExpanderPluginInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Communication\AvailabilityAlertCrossEngageCommunicationFactory getFactory()
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\Business\AvailabilityAlertCrossEngageFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\AvailabilityAlertCrossEngage\AvailabilityAlertCrossEngageConfig getConfig()
 */
class CrossEngageAvailabilityAlertMigratorExpanderPlugin extends AbstractPlugin implements AvailabilityAlertMigratorExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer $fosAvailabilityAlertSubscriptionEntityTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function expand(
        FosAvailabilityAlertSubscriptionEntityTransfer $fosAvailabilityAlertSubscriptionEntityTransfer,
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): AvailabilityAlertSubscriptionTransfer {
        $subscriber = $availabilityAlertSubscriptionTransfer->getSubscriber();

        if ($subscriber === null) {
            throw new Exception(sprintf(
                'Subscriber for subscription with id %s must not be null!',
                $availabilityAlertSubscriptionTransfer->getIdAvailabilityAlertSubscription()
            ));
        }

        $subscriber
            ->setSubscriberIp('from migration')
            ->setKey($this->getFacade()->generateKey($subscriber->getEmail()))
            ->setHash($this->getFactory()->getCrossEngageService()->getHash($subscriber->getEmail()));

        return $availabilityAlertSubscriptionTransfer->setSubscriber($subscriber);
    }
}
