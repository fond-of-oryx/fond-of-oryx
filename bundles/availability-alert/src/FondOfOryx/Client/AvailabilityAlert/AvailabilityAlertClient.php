<?php

namespace FondOfOryx\Client\AvailabilityAlert;

use Exception;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\AvailabilityAlert\AvailabilityAlertFactory getFactory()
 */
class AvailabilityAlertClient extends AbstractClient implements AvailabilityAlertClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer
     */
    public function subscribe(AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertRequestTransfer): AvailabilityAlertSubscriptionResponseTransfer
    {
        $transfer = $this->getFactory()
            ->createAvailabilityAlertStub()
            ->subscribe($availabilityAlertRequestTransfer);

        if ($transfer instanceof AvailabilityAlertSubscriptionResponseTransfer) {
            return $transfer;
        }

        throw new Exception('Wrong response!');
    }
}
