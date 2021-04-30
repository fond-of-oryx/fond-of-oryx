<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Dependency\Plugin;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;

interface AvailabilityAlertSubscriberPreSavePluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function preSave(AvailabilityAlertSubscriberTransfer $subscriberTransfer): AvailabilityAlertSubscriberTransfer;
}
