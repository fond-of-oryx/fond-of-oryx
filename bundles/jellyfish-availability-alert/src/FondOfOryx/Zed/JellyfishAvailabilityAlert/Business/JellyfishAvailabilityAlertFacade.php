<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\JellyfishAvailabilityAlertBusinessFactory getFactory()
 */
class JellyfishAvailabilityAlertFacade extends AbstractFacade implements JellyfishAvailabilityAlertFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer
     *
     * @return void
     */
    public function dispatchSubscriber(AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer): void
    {
        $this->getFactory()->createAvailabilityAlertSubscriberDispatcher()->dispatch($availabilityAlertSubscriberTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function dispatchSubscription(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void
    {
        $this->getFactory()->createAvailabilityAlertSubscriptionDispatcher()->dispatch($availabilityAlertSubscriptionTransfer);
    }
}
