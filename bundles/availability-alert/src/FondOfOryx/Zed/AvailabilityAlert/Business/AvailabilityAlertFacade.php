<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\Business\AvailabilityAlertBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\AvailabilityAlert\Persistence\AvailabilityAlertRepositoryInterface getRepository()
 */
class AvailabilityAlertFacade extends AbstractFacade implements AvailabilityAlertFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     * @param bool $preferFromTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer
     */
    public function subscribe(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer,
        bool $preferFromTransfer = false
    ): AvailabilityAlertSubscriptionResponseTransfer {
        return $this->getFactory()->createSubscriptionRequestHandler()
            ->processAvailabilityAlertSubscription($availabilityAlertSubscriptionTransfer, $preferFromTransfer);
    }

    /**
     * @api
     *
     * @return void
     */
    public function notifySubscribers(): void
    {
        $this->getFactory()->createSubscribersNotifier()->notify();
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function sendEmailNotification(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void
    {
        $this->getFactory()->createMailHandler()->notify($availabilityAlertSubscriptionTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return bool
     */
    public function preCheckSubscribersNotifierHasProductAssignedStores(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): bool {
        return $this->getFactory()
            ->createSubscribersNotifierHasProductAssignedStoresCheck()
            ->checkHasProductAssignedStores($availabilityAlertSubscriptionTransfer);
    }

    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return bool
     */
    public function preCheckSubscribersNotifierProductAttributeLaunchDateInPastOrIsEmpty(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): bool {
        return $this->getFactory()
            ->createSubscribersNotifierProductAttributeLaunchDateInPastOrIsEmptyCheck()
            ->checkHasProductAttributeLaunchDateInPastOrIsEmpty($availabilityAlertSubscriptionTransfer);
    }
}
