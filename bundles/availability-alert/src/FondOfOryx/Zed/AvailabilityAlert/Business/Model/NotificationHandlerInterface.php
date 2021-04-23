<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface NotificationHandlerInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function execute(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void;
}
