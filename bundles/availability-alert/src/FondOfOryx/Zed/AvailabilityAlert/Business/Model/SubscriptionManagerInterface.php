<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Business\Model;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionCollectionTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

interface SubscriptionManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return bool
     */
    public function isAlreadySubscribed(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    );

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return void
     */
    public function subscribe(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    );

    /**
     * @param  \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer  $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function updateSubscription(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): AvailabilityAlertSubscriptionTransfer;

    /**
     * @return array
     * @throws \Propel\Runtime\Exception\PropelException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function getCurrentSubscriptionCountPerProductAbstract(): array;

    /**
     * @param  int  $status
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionCollectionTransfer
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function getSubscriptionsForCurrentStoreAndStatus(int $status
    ): AvailabilityAlertSubscriptionCollectionTransfer;
}
