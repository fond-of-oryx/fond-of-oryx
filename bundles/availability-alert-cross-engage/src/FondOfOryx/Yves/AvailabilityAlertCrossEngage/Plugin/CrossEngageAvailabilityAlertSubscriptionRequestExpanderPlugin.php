<?php

namespace FondOfOryx\Yves\AvailabilityAlertCrossEngage\Plugin;

use FondOfOryx\Yves\AvailabilityAlertExtension\Dependency\Plugin\AvailabilityAlertSubscriptionRequestExpanderPlugin;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Symfony\Component\HttpFoundation\Request;

class CrossEngageAvailabilityAlertSubscriptionRequestExpanderPlugin implements AvailabilityAlertSubscriptionRequestExpanderPlugin
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
    ): AvailabilityAlertSubscriptionRequestTransfer {
        return $alertSubscriptionRequestTransfer
            ->setSubscriberIp($this->getCustomerIpAddress($request));
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return string|null
     */
    protected function getCustomerIpAddress(Request $request): ?string
    {
        $ipAddresses = $request->getClientIps();

        if (empty($ipAddresses)) {
            return null;
        }

        return end($ipAddresses) ?? null;
    }
}
