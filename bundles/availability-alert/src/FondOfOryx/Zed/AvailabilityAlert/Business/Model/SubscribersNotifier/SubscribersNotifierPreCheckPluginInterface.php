<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface SubscribersNotifierPreCheckPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return bool
     */
    public function checkCondition(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): bool;
}
