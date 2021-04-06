<?php

namespace FondOfOryx\Client\AvailabilityAlert\Zed;

use FondOfOryx\Client\AvailabilityAlert\Dependency\Client\AvailabilityAlertToZedRequestInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;

class AvailabilityAlertStub implements AvailabilityAlertStubInterface
{
    /**
     * @var \FondOfOryx\Client\AvailabilityAlert\Dependency\Client\AvailabilityAlertToZedRequestInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\AvailabilityAlert\Dependency\Client\AvailabilityAlertToZedRequestInterface $zedRequestClient
     */
    public function __construct(AvailabilityAlertToZedRequestInterface $zedRequestClient)
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
