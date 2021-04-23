<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Model\Dispatcher;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface AvailabilityAlertSubscriptionDispatcherInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function dispatch(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void;
}
