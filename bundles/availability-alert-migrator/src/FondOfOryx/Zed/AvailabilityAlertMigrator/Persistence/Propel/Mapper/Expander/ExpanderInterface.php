<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer;

interface ExpanderInterface
{
    /**
     * @param \Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer $fosAvailabilityAlertSubscriptionEntityTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function expand(
        FosAvailabilityAlertSubscriptionEntityTransfer $fosAvailabilityAlertSubscriptionEntityTransfer,
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): AvailabilityAlertSubscriptionTransfer;
}
