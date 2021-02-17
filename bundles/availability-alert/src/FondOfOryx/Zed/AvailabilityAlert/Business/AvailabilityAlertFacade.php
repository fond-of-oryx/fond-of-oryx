<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\AvailabilityAlert\Business\AvailabilityAlertBusinessFactory getFactory()
 */
class AvailabilityAlertFacade extends AbstractFacade implements AvailabilityAlertFacadeInterface
{
    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer
     */
    public function subscribe(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): AvailabilityAlertSubscriptionResponseTransfer {
        return $this->getFactory()->createSubscriptionRequestHandler()
            ->processAvailabilityAlertSubscription($availabilityAlertSubscriptionTransfer);
    }

    /**
     * @api
     *
     * @return void
     */
    public function notifySubscribers(): void
    {
        $this->getFactory()->createSubscribersNotifer()->notify();
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
    public function preCheckSubscribersNotifierProductAttributeReleaseDateInPastOrIsEmpty(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): bool {
        return $this->getFactory()
            ->createSubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyCheck()
            ->checkHasProductAttributeReleaseDateInPastOrIsEmpty($availabilityAlertSubscriptionTransfer);
    }
}
