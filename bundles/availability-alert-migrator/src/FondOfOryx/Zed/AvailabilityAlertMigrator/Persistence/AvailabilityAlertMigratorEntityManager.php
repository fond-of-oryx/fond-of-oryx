<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence;

use Exception;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractEntityManager;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\AvailabilityAlertMigratorPersistenceFactory getFactory()
 */
class AvailabilityAlertMigratorEntityManager extends AbstractEntityManager implements AvailabilityAlertMigratorEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return int|null
     */
    public function setMigrated(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): ?int
    {
        $availabilityAlertSubscriptionTransfer->requireSubscriber();
        $availabilityAlertSubscriptionTransfer->requireFkLocale();
        $availabilityAlertSubscriptionTransfer->requireFkProductAbstract();
        $availabilityAlertSubscriptionTransfer->requireFkStore();

        $subscriber = $availabilityAlertSubscriptionTransfer->getSubscriber();
        if ($subscriber === null) {
            return null;
        }

        $subscriber->requireEmail();

        $query = $this->getFactory()->createFosAvailabilityAlertSubscriptionQuery();
        $query
            ->filterByFkLocale($availabilityAlertSubscriptionTransfer->getFkLocale())
            ->filterByFkStore($availabilityAlertSubscriptionTransfer->getFkStore())
            ->filterByFkProductAbstract($availabilityAlertSubscriptionTransfer->getFkProductAbstract());

        $subscription = $query->findOneByEmail($subscriber->getEmail());

        if ($subscription === null) {
            return null;
        }
        try {
            $subscription->setMigrated(true)->save();
        } catch (Exception $exception) {
            return null;
        }

        return $subscription->getIdAvailabilityAlertSubscription();
    }
}
