<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Model\Dispatcher;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;

interface AvailabilityAlertSubscriberDispatcherInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer
     *
     * @return void
     */
    public function dispatch(AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer): void;
}
