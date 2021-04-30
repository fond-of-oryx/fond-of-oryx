<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface SubscribersNotifierHasProductAssignedStoresCheckInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return bool
     */
    public function checkHasProductAssignedStores(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): bool;
}
