<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription;

interface AvailabilityAlertMigrationDataMapperInterface
{
    /**
     * @param \Orm\Zed\AvailabilityAlert\Persistence\FosAvailabilityAlertSubscription $availabilityAlertSubscription
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function fromFosAvailabilityAlertSubscription(
        FosAvailabilityAlertSubscription $availabilityAlertSubscription
    ): AvailabilityAlertSubscriptionTransfer;
}
