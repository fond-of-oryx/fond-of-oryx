<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\PluginExecutor;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;

interface AvailabilityAlertSubscriberPluginExecutorInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function executePreSavePlugins(AvailabilityAlertSubscriberTransfer $subscriberTransfer): AvailabilityAlertSubscriberTransfer;

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer $subscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     */
    public function executePostSavePlugins(AvailabilityAlertSubscriberTransfer $subscriberTransfer): AvailabilityAlertSubscriberTransfer;
}
