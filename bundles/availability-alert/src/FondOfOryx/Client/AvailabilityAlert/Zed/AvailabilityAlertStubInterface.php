<?php

namespace FondOfOryx\Client\AvailabilityAlert\Zed;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;

interface AvailabilityAlertStubInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function subscribe(AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertRequestTransfer);
}
