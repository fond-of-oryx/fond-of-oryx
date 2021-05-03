<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Facade;

use FondOfOryx\Zed\AvailabilityAlert\Business\AvailabilityAlertFacadeInterface;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer;
use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;

class AvailabilityAlertMigratorToAvailabilityAlertFacadeBridge implements AvailabilityAlertMigratorToAvailabilityAlertFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\AvailabilityAlert\Business\AvailabilityAlertFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfOryx\Zed\AvailabilityAlert\Business\AvailabilityAlertFacadeInterface $availabilityAlertFacade
     */
    public function __construct(AvailabilityAlertFacadeInterface $availabilityAlertFacade)
    {
        $this->facade = $availabilityAlertFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     * @param bool $preferFromTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionResponseTransfer
     */
    public function subscribe(
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer,
        bool $preferFromTransfer = false
    ): AvailabilityAlertSubscriptionResponseTransfer {
        return $this->facade->subscribe($availabilityAlertSubscriptionTransfer, $preferFromTransfer);
    }
}
