<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\FooAvailabilityAlertSubscriptionEntityTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscription;

interface AvailabilityAlertSubscriptionMapperInterface
{
    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FooAvailabilityAlertSubscription $availabilityAlertSubscription
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function fromEntity(FooAvailabilityAlertSubscription $availabilityAlertSubscription): AvailabilityAlertSubscriptionTransfer;

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\FooAvailabilityAlertSubscriptionEntityTransfer
     */
    public function fromTransfer(AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer): FooAvailabilityAlertSubscriptionEntityTransfer;
}
