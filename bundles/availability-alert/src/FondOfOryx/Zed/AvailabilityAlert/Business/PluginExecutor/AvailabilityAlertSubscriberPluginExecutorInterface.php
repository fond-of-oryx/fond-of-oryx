<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface AvailabilityAlertSubscriberPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function executePreSavePlugins(
        AvailabilityAlertSubscriberTransfer $subscriberTransfer,
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
    ): AvailabilityAlertSubscriberTransfer;

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function executePostSavePlugins(
        AvailabilityAlertSubscriberTransfer $subscriberTransfer,
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriberTransfer
    ): AvailabilityAlertSubscriberTransfer;
}
