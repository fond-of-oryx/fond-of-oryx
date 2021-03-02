<?php

namespace FondOfOryx\Yves\AvailabilityAlertCrossEngage\Plugin;

use FondOfOryx\Yves\AvailabilityAlert\Dependency\Plugin\AvailabilityAlertSubscriptionRequestExpanderPlugin;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Symfony\Component\HttpFoundation\Request;

class CrossEngageAvailabilityAlertSubscriptionRequestExpanderPlugin implements AvailabilityAlertSubscriptionRequestExpanderPlugin
{
    /**
     * @param  \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer  $alertSubscriptionRequestTransfer
     * @param  array  $formData
     * @param  \Symfony\Component\HttpFoundation\Request  $request
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer
     */
    public function expand(
        AvailabilityAlertSubscriptionRequestTransfer $alertSubscriptionRequestTransfer,
        array $formData,
        Request $request
    ): AvailabilityAlertSubscriptionRequestTransfer {
        return $alertSubscriptionRequestTransfer
            ->setSubscriberIp($this->getCustomerIpAddress());
    }

    /**
     * @return string|null
     */
    protected function getCustomerIpAddress(): ?string
    {
        $ipAddress = $_SERVER['REMOTE_ADDR'];

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR']) {
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }

        return $ipAddress;
    }
}
