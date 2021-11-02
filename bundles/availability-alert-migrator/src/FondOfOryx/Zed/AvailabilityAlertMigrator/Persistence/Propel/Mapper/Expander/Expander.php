<?php

namespace FondOfOryx\Zed\AvailabilityAlertMigrator\Persistence\Propel\Mapper\Expander;

use Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer;
use Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer;

class Expander implements ExpanderInterface
{
    /**
     * @var array<\FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Plugin\AvailabilityAlertMigratorExpanderPluginInterface>
     */
    protected $plugins;

    /**
     * @param array<\FondOfOryx\Zed\AvailabilityAlertMigrator\Dependency\Plugin\AvailabilityAlertMigratorExpanderPluginInterface> $expanderPlugins
     */
    public function __construct(array $expanderPlugins)
    {
        $this->plugins = $expanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\FosAvailabilityAlertSubscriptionEntityTransfer $fosAvailabilityAlertSubscriptionEntityTransfer
     * @param \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
     *
     * @return \Generated\Shared\Transfer\AvailabilityAlertSubscriptionTransfer
     */
    public function expand(
        FosAvailabilityAlertSubscriptionEntityTransfer $fosAvailabilityAlertSubscriptionEntityTransfer,
        AvailabilityAlertSubscriptionTransfer $availabilityAlertSubscriptionTransfer
    ): AvailabilityAlertSubscriptionTransfer {
        foreach ($this->plugins as $plugin) {
            $availabilityAlertSubscriptionTransfer = $plugin->expand($fosAvailabilityAlertSubscriptionEntityTransfer, $availabilityAlertSubscriptionTransfer);
        }

        return $availabilityAlertSubscriptionTransfer;
    }
}
