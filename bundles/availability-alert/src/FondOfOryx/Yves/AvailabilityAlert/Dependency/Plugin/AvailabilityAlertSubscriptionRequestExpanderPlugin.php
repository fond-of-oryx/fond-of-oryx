<?php

namespace FondOfOryx\Yves\AvailabilityAlert\Dependency\Plugin;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Symfony\Component\HttpFoundation\Request;

interface AvailabilityAlertSubscriptionRequestExpanderPlugin
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $alertSubscriptionRequestTransfer
     * @param array $formData
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer
     */
    public function expand(
        AvailabilityAlertSubscriptionRequestTransfer $alertSubscriptionRequestTransfer,
        array $formData,
        Request $request
    ): AvailabilityAlertSubscriptionRequestTransfer;
}
