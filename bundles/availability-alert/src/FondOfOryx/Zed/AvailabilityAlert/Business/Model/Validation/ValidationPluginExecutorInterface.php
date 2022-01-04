<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\Validation;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface ValidationPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function validate(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void;
}
