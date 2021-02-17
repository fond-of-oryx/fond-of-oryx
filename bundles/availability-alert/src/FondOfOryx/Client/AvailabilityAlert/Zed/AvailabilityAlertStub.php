<?php

namespace FondOfOryx\Client\AvailabilityAlert\Zed;

use FondOfOryx\Client\AvailabilityAlert\Dependency\Client\AvailabilityAlertToZedRequestBridge;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;

class AvailabilityAlertStub implements AvailabilityAlertStubInterface
{
    /**
     * @var \FondOfOryx\Client\AvailabilityAlert\Dependency\Client\AvailabilityAlertToZedRequestBridge
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\AvailabilityAlert\Dependency\Client\AvailabilityAlertToZedRequestBridge $zedRequestClient
     */
    public function __construct(AvailabilityAlertToZedRequestBridge $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function subscribe(AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertRequestTransfer)
    {
        return $this->zedRequestClient->call('/availability-alert/gateway/subscribe', $availabilityAlertRequestTransfer);
    }
}
