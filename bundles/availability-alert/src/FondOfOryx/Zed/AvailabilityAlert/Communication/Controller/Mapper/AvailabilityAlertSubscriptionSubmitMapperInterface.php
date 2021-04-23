<?php

namespace FondOfOryx\Zed\AvailabilityAlert\Communication\Controller\Mapper;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer;

interface AvailabilityAlertSubscriptionSubmitMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function mapRequestTransfer(
        AvailabilityAlertSubscriptionRequestTransfer $availabilityAlertSubscriptionRequestTransfer
    );
}
