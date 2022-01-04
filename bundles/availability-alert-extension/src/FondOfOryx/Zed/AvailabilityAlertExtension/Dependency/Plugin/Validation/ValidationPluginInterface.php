<?php
namespace FondOfOryx\Zed\AvailabilityAlertExtension\Dependency\Plugin\Validation;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface ValidationPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function validate(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): void;
}
