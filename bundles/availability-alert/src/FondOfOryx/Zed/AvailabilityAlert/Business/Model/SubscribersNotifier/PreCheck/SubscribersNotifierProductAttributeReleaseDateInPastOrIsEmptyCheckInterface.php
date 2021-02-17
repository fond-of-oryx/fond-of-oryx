<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model\SubscribersNotifier\PreCheck;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface SubscribersNotifierProductAttributeReleaseDateInPastOrIsEmptyCheckInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return bool
     */
    public function checkHasProductAttributeReleaseDateInPastOrIsEmpty(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): bool;
}
