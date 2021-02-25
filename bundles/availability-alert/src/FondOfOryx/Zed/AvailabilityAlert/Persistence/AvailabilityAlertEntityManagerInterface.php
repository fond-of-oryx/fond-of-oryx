<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Persistence;

use Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface AvailabilityAlertEntityManagerInterface
{
    /**
     * @param  \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer  $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function createOrUpdateSubscription(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): AvailabilityAlertSubscriptionTransfer;

    /**
     * @param  \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer  $availabilityAlertSubscriberTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriberTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function createOrUpdateSubscriber(AvailabilityAlertSubscriberTransfer $availabilityAlertSubscriberTransfer
    ): AvailabilityAlertSubscriberTransfer;
}
